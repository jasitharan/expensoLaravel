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


    public function createComment(Request $request)
    {


        $request->validate([
            'comment' => 'required',
            'news_id' => 'required',
            'user_id' => 'required'
        ]);
        $comment = new Comment();
        $comment->news_id = $request->input('news_id');
        $comment->user_id = $request->input('user_id');
        $comment->comment = $request->input('comment');
        $comment->save();



        return redirect('/comments/create')->with('success', 'Comment Created');
    }
}
