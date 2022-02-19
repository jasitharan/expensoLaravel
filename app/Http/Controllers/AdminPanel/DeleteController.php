<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Models\News;
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

    public function deleteNews(Request $request)
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

    public function deleteCategory(Request $request)
    {
        $category = Category::find($request->name);

        if ($category->url_image != null) {
            if ($category->url_image !=  Storage::url('images/category_images/noimage.jpg')) {
                // return $category->url_image;
                Storage::delete(strstr($category->url_image, "/images"));
            }
        }


        $category->delete();

        return redirect('category')->with('success', 'Category Deleted Successfully');
    }

   
}
