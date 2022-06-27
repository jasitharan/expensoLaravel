<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminPanel\UtilController;
use App\Models\ExpenseType;
use App\Models\Expense;
use App\Models\Company;
use App\Models\Address;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class CreateController extends Controller
{

    // User
    public function createUser(Request $request)
    {

        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'role' => 'required',
            'company_id' => 'required|exists:companies,id',
            'url_image' => 'image||nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($request->hasFile('url_image')) {
            // Upload image
            $path = Storage::disk('public')->put('images/user_images', $request->url_image);
        } else {
            $path = 'images/user_images/noimage.jpg';
        }

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'role' => $fields['role'],
            'company_id' => $fields['company_id'],
            'password' => bcrypt($fields['password']),
            'url_image' => Storage::url($path)
        ]);


        
        return redirect('/users/create')->with('success', 'User Created');
    }

    // Expense Type
    public function createExpenseType(Request $request)
    {


        $fields =  $request->validate([
            'expType' => 'required|unique:expense_types',
            'expCostLimit' => 'required|numeric|between:0,999999999999.9999',
            'url_image' => 'image||nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);
        
        if ($request->hasFile('url_image')) {
            // Upload image
            $path = Storage::disk('public')->put('images/expense_type_images', $request->url_image);
        } else {
            $path = 'images/expense_type_images/noimage.jpg';
        }

        $modifiedBy = auth()->user()->name;


         ExpenseType::create([
            'expType' => $fields['expType'],
            'expCostLimit' => $fields['expCostLimit'],
            'createdDate' => Carbon::now(),
            'updatedDate' => Carbon::now(),
            'modifedBy' => $modifiedBy,
            'url_image' => Storage::url($path)
        ]);

        return redirect('/expense_types/create')->with('success', 'Expense Type Created');
    }
    
    
     // Companies
     public function createCompany(Request $request)
     {
 
 
         $fields =  $request->validate([
             'name' => 'required|unique:companies',
             'address' => 'required|string',
             'city' => 'required|string',
             'province' => 'required|string',
             'country' => 'required|string'
         ]);
         
         
         $address = Address::create([
                'address' => $fields['address'],
                'city' => $fields['city'],
                'province' => $fields['province'],
                'country' => $fields['country']
            ]);
 
 
          Company::create([
             'name' => $fields['name'],
             'address_id' => $address->id
         ]);
 
         return redirect('/companies/create')->with('success', 'Company Created');
     }

    //Expense
    public function createExpense(Request $request)
    {

        $fields =  $request->validate([
            'user_id' => 'required',
            'createdDate' => 'required|date',
            'status' => 'required',
            'expenseCost' => 'required|numeric|between:0,999999999999.9999',
            'expenseFor' => 'required|string',
            'expenseType_id' => 'required|exists:expense_types,id'
        ]);


         Expense::create([
            'user_id' => $fields['user_id'],
            'createdDate' => $fields['createdDate'],
            'expenseCost' => $fields['expenseCost'],
            'expenseFor' => $fields['expenseFor'],
            'status' => $fields['status'],
            'expenseType_id' => $fields['expenseType_id'],
        ]);


        return redirect('/expenses/create')->with('success', 'Expense Created');
    }



   
}
