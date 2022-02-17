<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use App\Models\Setting;
use App\Models\ShowEntry;
use App\Models\User;
use Illuminate\Http\Request;

class ViewController extends Controller
{

    public function getDashBoard()
    {
        // $news = News::all();
        // $sorted = $news->sortByDesc('created_at',)->take(5);
        // $data = array(
        //     'news' => $sorted,
        //     'total_news' => count($news),
        //     'total_categories' => count(Category::all()),
        //     'total_comments' => count(Comment::all()),
        //     'total_users' => count(User::all()->where('role', 'user'))
        // );
        $data = array(
            'news' => [],
            'total_news' => 10,
            'total_categories' => 10,
            'total_comments' => 10,
            'total_users' => count(User::all()->where('role', 'user'))
        );
        return view('dashboard')->with($data);
    }


    // Category

    public function getCategoryList(Request $request)
    {

        $limit = ShowEntry::first()->category;


        $categories = Category::sortable(['name', 'created_at'])->paginate($limit);


        if ($request->hasAny('search')) {
            $categories =  Category::where('name', 'like', '%' . $request->input('search') . '%')->paginate($limit);
        }





        $data = array(
            'categories' => $categories,
            'limit' => $limit
        );
        return view('category.get_category')->with($data);
    }

    public function getCreateCategory()
    {
        return view('category.create_category');
    }

    public function getEditCategory(Request $request)
    {

        $data = array(
            'category' => Category::find($request->name)
        );;
        return view('category.edit_category')->with($data);
    }


    // News

    public function getNewsList(Request $request)
    {

        $limit = ShowEntry::first()->news;

        $news = News::sortable(['title', 'created_at'])->paginate($limit);



        if ($request->hasAny('search')) {
            $news =  News::where('title', 'like', '%' . $request->input('search') . '%')->paginate($limit);
        }

        $data = array(
            'news' => $news,
            'limit' => $limit
        );
        return view('news.get_news')->with($data);
    }

    public function getCreateNews()
    {
        $data = array(
            'categories' => Category::all()
        );
        return view('news.create_news')->with($data);
    }

    public function getEditNews(Request $request)
    {
        $data = array(
            'news' => News::where('id', $request->id)->first(),
            'categories' => Category::all()
        );;

        return view('news.edit_news')->with($data);
    }

    // Comments

    public function getCommentList(Request $request)
    {

        $limit = ShowEntry::first()->comment;


        $comments = Comment::sortable([
            'comment', 'user_id',
            'news_id', 'created_at'
        ])->paginate($limit);


        foreach ($comments as $comment) {
            $comment->user_name = User::find($comment->user_id)->name;
            $comment->news_title = News::find($comment->news_id)->title;
        }

        if ($request->hasAny('search')) {
            $comments =  Comment::where('comment', 'like', '%' . $request->input('search') . '%')->paginate($limit);
        }


        $data = array(
            'comments' => $comments,
            'limit' => $limit
        );
        return view('comments.get_comment')->with($data);
    }

    public function getCreateComment()
    {
        $data = array(
            'users' => User::all()->where('role', 'user'),
            'news' => News::all(),

        );

        return view('comments.create_comment')->with($data);
    }

    public function getEditComment(Request $request)
    {

        $data = array(
            'comment' => Comment::find($request->id),
            'users' => User::all()->where('role', 'user'),
            'news' => News::all(),

        );
        return view('comments.edit_comment')->with($data);
    }
}
