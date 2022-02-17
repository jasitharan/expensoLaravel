<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use App\Models\ShowEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class EditController extends Controller
{
    public function editNews(Request $request)
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

    public function editCategory(Request $request, $name)
    {

        $request->validate([
            'name' => 'string',
            'url_image' => 'image||nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);


        $category = Category::find($name);



        if ($request->hasAny('url_image')) {

            $request->validate([
                'url_image' => 'image||mimes:jpeg,jpg,png,gif|required|max:10000'
            ]);

            if ($category->url_image != null) {
                if ($category->url_image !=  Storage::url('images/category_images/noimage.jpg')) {
                    // return $category->url_image;
                    Storage::delete(strstr($category->url_image, "/images"));
                }
            }


            if ($request->hasFile('url_image')) {
                // Upload image
                $path = Storage::put('images/category_images', $request->url_image, 'public');
            } else {
                $path = 'images/category_images/noimage.jpg';
            }
        } else {
            $fileNameToStore = $category->url_image;
        }


        $category->update([
            'name' => $request->name,
            'url_image' => !isset($path) ? $fileNameToStore : Storage::url($path)
        ]);


        return redirect('category/' . $request->name . '/edit')->with('success', 'Updated Successfully');
    }

    public function editComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
            'news_id' => 'required',
            'user_id' => 'required'
        ]);

        try {
            $comment = Comment::find($id);
            $comment->update($request->all());
        } catch (Throwable $e) {
            echo $e;
        }

        return redirect('comments/' . $request->id . '/edit')->with('success', 'Updated Successfully');
    }

    public function editShowEntry(Request $request)
    {



        $request->validate([
            'news' => 'integer',
            'comment' => 'integer',
            'category' => 'integer'
        ]);


        $show_entry = ShowEntry::first();




        $show_entry->update(
            [
                'news' => $request->input('news-limit') != null ? intval($request->input('news-limit')) : $show_entry->news,
                'comment' => $request->input('comment-limit') != null ? intval($request->input('comment-limit')) : $show_entry->comment,
                'category' => $request->input('category-limit') != null ? intval($request->input('category-limit')) : $show_entry->category,
            ]
        );

        if ($request->input('news-limit') != null) {
            return redirect('news');
        }

        if ($request->input('comment-limit') != null) {
            return redirect('comments');
        }

        if ($request->input('category-limit') != null) {
            return redirect('category');
        }
    }
}
