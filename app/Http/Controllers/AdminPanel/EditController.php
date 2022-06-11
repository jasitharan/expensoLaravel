<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\ExpenseType;
use App\Models\User;
use App\Models\Expense;
use App\Models\Setting;
use App\Models\ShowEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;


class EditController extends Controller
{
    

    // User
    public function editUser(Request $request, $id)
    {
        $user = User::find($id);
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'. $id,
            'role' => 'required',
            'url_image' => 'image||nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

      

        if ($request->hasFile('url_image')) {

            if ($user->url_image != null) {

                if ($user->url_image != Storage::url('images/user_images/noimage.jpg')) {
                    // Need to delete
                    Storage::delete(strstr($user->url_image, "/images"));
                }
            }

            // Upload image
            $path = Storage::disk('public')->put('images/user_images', $request->url_image);
        } 

        if (empty($path) ) {
            $url_image  = $user->url_image;
        } else {
            $url_image = Storage::url($path);
        }

        try {
            
            $user->update([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'role' => $fields['role'],
                'url_image' => $url_image
            ]);
        } catch (Throwable $e) {
            echo $e;
        }

        return redirect('users/' . $request->id . '/edit')->with('success', 'Updated Successfully');
    }


    //Expense Type
    public function editExpenseType(Request $request, $id)
    {

        $fields = $request->validate([
            'expType' => 'unique:expense_types,expType,'.$id,
            'expCostLimit' => 'numeric|between:0,999999999999.9999',
        ]);



        $expenseType = ExpenseType::find($id);

        $modifiedBy = auth()->user()->name;



        $expenseType->update([
            'expType' => $fields['expType'],
            'expCostLimit' => $fields['expCostLimit'],
            'modifedBy' => $modifiedBy
        ]);


        return redirect('expense_types/' . $request->id . '/edit')->with('success', 'Updated Successfully');
    }

    public function editExpense(Request $request)
    {
        $expense = Expense::find($request->id);

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


        $expense->update([
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

       
        return redirect('expenses/' . $request->id . '/edit')->with('success', 'Updated Successfully');
    }

 
    public function editPendingExpense(Request $request)
    {

        $request->validate([
            'status' => 'required',
        ]);

        $pending_expense = Expense::find($request->id);
        
        

        $pending_expense->update(
            [
                'status' => $request->input('status'),
               
            ]
        );
        

        
        return redirect('pending_expenses/')->with('success', 'Updated Successfully');
    }



    public function editShowEntry(Request $request)
    {



        $request->validate([
            'expense_types' => 'integer',
            'expenses' => 'integer',
            'users' => 'integer'
        ]);


        $show_entry = ShowEntry::first();




        $show_entry->update(
            [
                'expense_types' => $request->input('expense_types-limit') != null ? intval($request->input('expense_types-limit')) : $show_entry->expense_types,
                'expenses' => $request->input('expenses-limit') != null ? intval($request->input('expenses-limit')) : $show_entry->expenses,
                'users' => $request->input('users-limit') != null ? intval($request->input('users-limit')) : $show_entry->users,
            ]
        );

        if ($request->input('expense_types-limit') != null) {
            return redirect('expense_types');
        }

        if ($request->input('expenses-limit') != null) {
            return redirect('expenses');
        }

        if ($request->input('users-limit') != null) {
            return redirect('users');
        }
    }
    
  
}
