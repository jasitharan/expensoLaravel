<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ExpenseType;
use App\Models\Expense;
use App\Models\Company;
use App\Models\Setting;
use App\Models\ShowEntry;
use App\Models\User;
use Illuminate\Http\Request;

class ViewController extends Controller
{

    public function getDashBoard()
    {
        $expenses = Expense::where('status','like','Unknown')->get();
        $sorted = $expenses->sortByDesc('created_at',)->take(5);
        $data = array(
            'expenses' => $sorted,
            'total_expenses' => count(Expense::all()),
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
              'users' => User::all(),
              'companies' => Company::all()
          );
          return view('users.create_users')->with($data);
      }
  
      public function getEditUser(Request $request)
      {
          $data = array(
              'user' => User::where('id', $request->id)->first(),
              'companies' => Company::all()
          );;
  
          return view('users.edit_users')->with($data);
      }
      
      
      // Companies
      
    public function getCompanyList(Request $request)
    {

        $limit = ShowEntry::first()->companies;

        $companies = Company::where('name','!=','all')->sortable(['name'])->paginate($limit);


        if ($request->hasAny('search')) {
            $companies =  Company::where('name', 'like', '%' . $request->input('search') . '%')->paginate($limit);
        }


        $data = array(
            'companies' => $companies,
            'limit' => $limit
        );
        return view('companies.get_companies')->with($data);
    }

    public function getCreateCompany()
    {
        return view('companies.create_company');
    }

    public function getEditCompany(Request $request)
    {

        $data = array(
            'company' => Company::find($request->id)
        );;
        return view('companies.edit_company')->with($data);
    }



    // Expense Type

    public function getExpenseTypeList(Request $request)
    {

        $limit = ShowEntry::first()->expense_types;

        $expenseTypes = ExpenseType::sortable(['expType', 'expCostLimit' ,'created_at'])->paginate($limit);


        if ($request->hasAny('search')) {
            $expenseTypes =  ExpenseType::where('expType', 'like', '%' . $request->input('search') . '%')->paginate($limit);
        }


        $data = array(
            'expenseTypes' => $expenseTypes,
            'limit' => $limit
        );
        return view('expenseTypes.get_expense_types')->with($data);
    }

    public function getCreateExpenseType()
    {
        return view('expenseTypes.create_expense_type');
    }

    public function getEditExpenseType(Request $request)
    {

        $data = array(
            'expType' => ExpenseType::find($request->id)
        );;
        return view('expenseTypes.edit_expense_type')->with($data);
    }


    // Expense

    public function getExpenseList(Request $request)
    {

        $limit = ShowEntry::first()->expenses;

        $expenses = Expense::sortable(['expenseCost', 'expenseType_id','created_at'])->paginate($limit);



        if ($request->hasAny('search')) {
            $expenses =  Expense::where('expenseFor', 'like', '%' . $request->input('search') . '%')->paginate($limit);
        }

        $data = array(
            'expenses' => $expenses,
            'limit' => $limit
        );
        return view('expenses.get_expenses')->with($data);
    }

    public function getPendingExpenseList(Request $request)
    {

        $limit = ShowEntry::first()->expenses;

        $expenses = Expense::where('status','like','Unknown');
        

        $expenses =  $expenses -> sortable(['expenseCost', 'expenseType_id','created_at'])->paginate($limit);



        if ($request->hasAny('search')) {
            $expenses =  Expense::where('expenseFor', 'like', '%' . $request->input('search') . '%')->paginate($limit);
        }

        $data = array(
            'expenses' => $expenses,
            'limit' => $limit
        );
        return view('pending_expenses.get_expenses')->with($data);
    }

    public function getCreateExpense()
    {
        $data = array(
            'expense_types' => ExpenseType::all(),
            'users' => User::all()
        );
        return view('expenses.create_expenses')->with($data);
    }

    public function getEditExpense(Request $request)
    {
        $data = array(
            'expense' => Expense::find($request->id),
            'expense_types' => ExpenseType::all(),
            'users' => User::all()
        );;

        return view('expenses.edit_expenses')->with($data);
    }

    
}
