<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Address;
use App\Models\Bank;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AuthController extends Controller
{


    public function register(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'dob' => 'date',
            'address' => 'required|string',
            'city' => 'required|string',
            'postalcode' => 'digits',
            'province' => 'required|string',
            'country' => 'required|string',
            'bank_branch' => 'string',
            'bank_name' => 'string',
            'bank_number' => 'digits_between:5,20|unique:banks,number',
            'company_id' => 'required|exists:companies,id',
            'phoneNumber' => 'digits:9',
            'password' => 'required|string|confirmed',
            'url_image' => 'image||nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($request->hasFile('url_image')) {
            // Upload image
            $path = Storage::put('images/user_images', $request->url_image, 'public');
        } else {
            $path = 'images/user_images/noimage.jpg';
        }

        $address = Address::create([
            'address' => $fields['address'],
            'city' => $fields['city'],
            'province' => $fields['province'],
            'country' => $fields['country']
        ]);

        $bank;

        if (!empty(request('bank_number'))) {


            $fields2 = $request->validate([
                'bank_branch' => 'required|string',
                'bank_name' => 'required|string',
                'bank_number' => 'digits_between:5,20|unique:banks,number'
            ]);
            $bank = Bank::create([
                'number' => $fields2['bank_number'],
                'branch' => $fields2['bank_branch'],
                'name' => $fields2['bank_name']
            ]);
        }



        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'dob' => $fields['dob'] ?? null,
            'company_id' => $fields['company_id'],
            'phoneNumber' => $fields['phoneNumber'] ?? null,
            'password' => bcrypt($fields['password']),
            'url_image' => Storage::url($path),
            'address_id' => $address->id ?? null,
            'bank_id' => $bank->id ?? null
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 200);
    }

    public function logout(Request $request)
    {

        // Get user who requested the logout
        $user = request()->user(); //or Auth::user()
        // Revoke current user token
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return [
            'message' => 'Logged out'
        ];
    }

    public function updateDetail(Request $request)
    {

        $user = request()->user();



        try {
            $field = $request->validate([
                'name' => 'string',
                'email' => 'unique:users,email,' . $user->id,
                'phoneNumber' => 'string|min:10,max:10',
                'url_image' => 'image||nullable|mimes:jpeg,jpg,png,gif|max:10000',
                'dob' => 'date'
            ]);

            $field2 = $request->validate([
                'address' => 'string',
                'city' => 'string',
                'postalcode' => 'digits',
                'province' => 'string',
                'country' => 'string',
            ]);

            if (!empty($user->bank_id)) {
                $request->validate([
                    'bank_branch' => 'string',
                    'bank_name' => 'string',
                    'bank_number' => 'digits_between:5,20|unique:banks,number,' . $user->bank_id
                ]);

                $field3 = [];

                if (!empty($request->input('bank_number'))) {
                    $field3['number'] = $request->input('bank_number');
                }

                if (!empty($request->input('bank_name'))) {
                    $field3['name'] = $request->input('bank_name');
                }

                if (!empty($request->input('bank_branch'))) {
                    $field3['branch'] = $request->input('bank_branch');
                }
            } else {

                if (!empty($request->input('bank_number')) || !empty($request->input('bank_name')) || !empty($request->input('bank_branch'))) {
                    $field3 = $request->validate([
                        'bank_branch' => 'required|string',
                        'bank_name' => 'required|string',
                        'bank_number' => 'required|digits_between:5,20|unique:banks,number'
                    ]);
                }
            }
        } catch (Throwable $e) {
            return response([
                "message" => 'Something went wrong'
            ], 500);
        }



        if ($request->hasAny('url_image')) {

            if ($user->url_image != null) {
                if ($user->url_image !=  Storage::url('images/user_images/noimage.jpg')) {
                    // return $category->url_image;
                    Storage::delete(strstr($user->url_image, "/images"));
                }
            }


            if ($request->hasFile('url_image')) {
                // Upload image
                $path = Storage::disk('public')->put('images/user_images', $request->url_image);
            } else {
                $path = 'images/user_images/noimage.jpg';
            }

            $field['url_image'] = Storage::url($path);
        }

        if ($request->hasAny('email') && $user->email != $request->get('email')) {
            $field['email_verified_at'] = null;
        }


        Address::where('id', $user->address_id)->update($field2);

        if (!empty($user->bank_id)) {

            Bank::where('id', $user->bank_id)->update($field3);
        } else {
            if (!empty($request->input('bank_number'))) {
                $bank = Bank::create([
                    'number' => $field3['bank_number'],
                    'branch' => $field3['bank_branch'],
                    'name' => $field3['bank_name']
                ]);

                $field['bank_id'] = $bank->id;
            }
        }

        $user->update($field);

        
    

      $response = [
            "user" => $user
        ];
        
        return response($response, 200);
    }

    public function checkUser(Request $request)
    {
        return [
            "message" => "authenticated."
        ];
    }
}
