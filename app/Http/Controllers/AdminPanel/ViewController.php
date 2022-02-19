<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ExpenseType;
use App\Models\Expense;
use App\Models\Setting;
use App\Models\ShowEntry;
use App\Models\User;
use Illuminate\Http\Request;

class ViewController extends Controller
{

    public function getDashBoard()
    {
         $expenses = Expense::all();
         $sorted = $expenses->sortByDesc('created_at',)->take(5);
        $data = array(
            'expenses' => $sorted,
            'total_expenses' => count($expenses),
            'total_expenseTypes' => count(ExpenseType::all()),
            'total_users' => count(User::all()->where('role', 'employee'))
        );
    
        return view('dashboard')->with($data);
    }

      // User

      public function getUserList(Request $request)
      {
  
          $limit = ShowEntry::first()->users;

          $users = User::where('id', '!=', request()->user()->id);

          $users = $users->sortable(['name', 'created_at'])->paginate($limit);

  
          if ($request->hasAny('search')) {
              $users =  User::where('name', 'like', '%' . $request->input('search') . '%')->paginate($limit);
          }

      
  
          $data = array(
              'users' => $users,
              'limit' => $limit
          );
          return view('users.get_users')->with($data);
      }
  
      public function getCreateUser()
      {
          $data = array(
              'users' => User::all()
          );
          return view('users.create_users')->with($data);
      }
  
      public function getEditUser(Request $request)
      {
          $data = array(
              'user' => User::where('id', $request->id)->first(),
          );;
  
          return view('users.edit_users')->with($data);
      }


    // Expense Type

    public function getExpenseTypeList(Request $request)
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

    
}
