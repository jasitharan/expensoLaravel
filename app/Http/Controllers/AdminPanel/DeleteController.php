<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\ExpenseType;
use App\Models\User;
use App\Models\Expense;
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
        $news = News::find($request->id);


        if ($news->url_image != null) {

            if ($news->url_image != Storage::url('images/news_images/noimage.jpg') && !str_contains($news->url_image, 'category_images')) {
                // Need to delete
                Storage::delete(strstr($news->url_image, "/images"));
            }
        }

        $news->delete();

        return redirect('news')->with('success', 'News Deleted Successfully');
    }

 

   
}
