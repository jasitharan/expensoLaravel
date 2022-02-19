<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminPanel\UtilController;
use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use App\Models\User;
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


        return redirect('/users/create')->with('success', 'User Created');
    }

    public function createNews(Request $request)
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


    public function createCategory(Request $request)
    {


        $request->validate([
            'name' => 'required|unique:categories',
            'url_image' => 'image||nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($request->hasFile('url_image')) {
            // Upload image
            $path = Storage::put('images/category_images', $request->url_image, 'public');
        } else {
            $path = 'images/category_images/noimage.jpg';
        }

        Category::create([
            'name' => $request->name,
            'url_image' => Storage::url($path)
        ]);


        return redirect('/category/create')->with('success', 'Category Created');
    }


   
}
