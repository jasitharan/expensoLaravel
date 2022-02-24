<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminPanel\UtilController;
use App\Models\ExpenseType;
use App\Models\Expense;
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
            'role' => $fields['role'],
            'password' => bcrypt($fields['password']),
            'url_image' => Storage::url($path)
        ]);


        
        return redirect('/users/create')->with('success', 'User Created');
    }

    // Expense Type
    public function createExpenseType(Request $request)
    {


        $request->validate([
            'expType' => 'required|unique:expense_types',
            'expCostLimit' => 'required|numeric|between:0,999999999999.9999',
        ]);

        $modifiedBy = auth()->user()->name;


         ExpenseType::create([
            'expType' => $request->expType,
            'expCostLimit' => $request->expCostLimit,
            'createdDate' => Carbon::now(),
            'updatedDate' => Carbon::now(),
            'modifedBy' => $modifiedBy
        ]);

        return redirect('/expense_types/create')->with('success', 'Expense Type Created');
    }

    //Expense
    public function createExpense(Request $request)
    {

        $fields =  $request->validate([
            'user_id' => 'required',
            'createdDate' => 'required|date',
            'receiptPath' => 'string',
            'expenseCost' => 'required|numeric|between:0,999999999999.9999',
            'expenseFor' => 'required|string',
            'otherExpense' => 'string',
            'rentalAgency' => 'string',
            'status' => 'required',
            'carClass' => 'string',
            'ticketNo' => 'string',
            'airline' => 'string',
            'daysInHotel' => 'integer',
            'hotelName' => 'string',
            'expenseType_id' => 'required|exists:expense_types,id'
        ]);


         Expense::create([
            'user_id' => $fields['user_id'],
            'createdDate' => $fields['createdDate'],
            'receiptPath' =>  $fields['receiptPath'] ?? null,
            'expenseCost' => $fields['expenseCost'],
            'expenseFor' => $fields['expenseFor'],
            'status' => $fields['status'],
            'otherExpense' => $fields['otherExpense'] ?? null,
            'rentalAgency' => $fields['rentalAgency'] ?? null,
            'carClass' => $fields['carClass'] ?? null,
            'ticketNo' => $fields['ticketNo'] ?? null,
            'airline' => $fields['airline'] ?? null,
            'daysInHotel' => $fields['daysInHotel'] ?? null,
            'hotelName' => $fields['hotelName'] ?? null,
            'expenseType_id' => $fields['expenseType_id'],
        ]);


        return redirect('/expenses/create')->with('success', 'Expense Created');
    }



   
}
