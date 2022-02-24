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


    public function createExpense(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_name' => 'required|string',
            'url_image' => 'image||nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);



        if ($request->hasFile('url_image')) {
            // Upload image
            $path = Storage::put('images/news_images', $request->url_image, 'public');
        }



        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'published' => $request->published,
            'headline' => $request->headline,
            'url_image' => !isset($path) ? Category::find($request->category_name)->url_image : Storage::url($path),
            'category_name' => $request->category_name
        ]);


        return redirect('/news/create')->with('success', 'News Created');
    }



   
}
