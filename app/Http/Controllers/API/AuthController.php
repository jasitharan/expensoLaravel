<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'url_image' => 'image||nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($request->hasFile('url_image')) {
            // Upload image
            $path = Storage::put('images/user_images', $request->url_image, 'public');
        } else {
            $path = 'images/user_images/noimage.jpg';
        }

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'url_image' => Storage::url($path)
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
            'email' => 'required|string',
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

        return response($response, 201);
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
                'url_image' => 'image||nullable|mimes:jpeg,jpg,png,gif|max:10000'
            ]);
        } catch (Throwable $e) {
            return response([
                "message" => 'Something went wrong'
            ], 500);
        }



        $updateArr = [];

        if ($request->hasAny(['name', 'email', 'url_image'])) {
            if ($request->filled('name')) {
                if ($field['name']) {
                    $updateArr['name'] = $field['name'];
                }
            }
            if ($request->filled('email')) {
                if ($field['email'])
                    $updateArr['email'] = $field['email'];
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
                    $path = Storage::put('images/user_images', $request->url_image, 'public');
                } else {
                    $path = 'images/user_images/noimage.jpg';
                }

                $updateArr['url_image'] = Storage::url($path);
            }
        }


        $update = User::where('id', $user->id)->update($updateArr);

        return [
            "data" => $updateArr
        ];
    }

    public function checkUser(Request $request)
    {
        return [
            "message" => "authenticated."
        ];
    }
}
