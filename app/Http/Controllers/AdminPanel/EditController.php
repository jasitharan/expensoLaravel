<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\ExpenseType;
use App\Models\User;
use App\Models\Expense;
use App\Models\ShowEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class EditController extends Controller
{

    // User
    public function editUser(Request $request, $id)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'. $id,
            'role' => 'required',
            'url_image' => 'image||nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        try {
            $user = User::find($id);
            $user->update([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'role' => $fields['role']
        //        'url_image' => Storage::url($path)
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
        $news = News::find($request->id);


        if ($request->hasAny('url_image')) {

            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'category_name' => 'required|string',
                'url_image' => 'image||mimes:jpeg,jpg,png,gif|required|max:10000'
            ]);

            if ($news->url_image != null) {

                if ($news->url_image != Storage::url('images/news_images/noimage.jpg')) {
                    // Need to delete
                    Storage::delete(strstr($news->url_image, "/images"));
                }
            }


            if ($request->hasFile('url_image')) {
                // Upload image
                $path = Storage::put('images/news_images', $request->url_image, 'public');
            } else {
                $path = 'images/news_images/noimage.jpg';
            }
        } else {
            $fileNameToStore = $news->url_image;
        }






        $news->update([
            'title' => $request->title,
            'content' => $request->content,
            'published' => $request->published,
            'headline' => $request->headline,
            'url_image' =>  !isset($path) ? $fileNameToStore : Storage::url($path),
            'category_name' => $request->category_name
        ]);


        return redirect('news/' . $request->id . '/edit')->with('success', 'Updated Successfully');
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
