<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\ExpenseType;
use App\Models\User;
use App\Models\Expense;
use App\Models\Address;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteController extends Controller
{

    // Delete User
    public function deleteUser(Request $request)
    {
        User::destroy($request->id);

        return redirect('users')->with('success', 'User Deleted Successfully');
    }

    // Expense Type
    public function deleteExpenseType(Request $request)
    {
        $expenseType = ExpenseType::find($request->id);
        $expenseType->delete();

        return redirect('expense_types')->with('success', 'Expense Type Deleted Successfully');
    }

    public function deleteExpense(Request $request)
    {
        $expense = Expense::find($request->id);


        if ($expense->url_image != null) {

            if ($expense->url_image != Storage::url('images/expenses_images/noimage.jpg') && !str_contains($expense->url_image, 'category_images')) {
                // Need to delete
                Storage::delete(strstr($expense->url_image, "/images"));
            }
        }

        $expense->delete();

        return redirect('expenses')->with('success', 'Expense Deleted Successfully');
    }
    
    public function deleteCompany(Request $request)
    {
        $company = Company::find($request->id);

        $address = Address::find($company->address_id);
      
        $company->delete();
        
        $address->delete();

        return redirect('companies')->with('success', 'Company Deleted Successfully');
    }

 

   
}
