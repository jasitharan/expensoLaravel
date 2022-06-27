<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Carbon\Carbon;


class ExpenseController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $query = Expense::where('user_id', $user_id)->get()->sortByDesc('createdDate');
        
        if (!empty(request('expenseType_id'))) {
            $query = $query->where('expenseType_id',request('expenseType_id'));
        }
        
        if (!empty(request('status'))) {
            $query = $query->where('status',request('status'));
        }
        
        if (!empty(request('startDate')) && !empty(request('endDate'))) {
            $query = $query->whereBetween('createdDate', [request('startDate'), request('endDate')]);
        }
        
        
        if (!empty(request('skip')) || !empty(request('take'))) {
            $query = $query->skip(request('skip'))->take(request('take'));
        }
        
         return $query->values();
    }

    public function store(Request $request)
    {
        try {
            $fields =  $request->validate([
                'createdDate' => 'required|date',
                'expenseCost' => 'required|numeric|between:0,999999999999.9999',
                'expenseFor' => 'required|string',
                'expenseType_id' => 'required|exists:expense_types,id'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'errors' => $th->errors(),
            ], 422);
        }
      

     
        $user_id = auth()->user()->id;


       
            // Validate the value...
           $expense =  Expense::create([
                'user_id' => $user_id,
                'createdDate' => $fields['createdDate'],
                'expenseCost' => $fields['expenseCost'],
                'expenseFor' => $fields['expenseFor'],
                'status' => 'Unknown',
                'expenseType_id' => $fields['expenseType_id'],
            ]);

        return $expense;
      

    }

    public function show($id)
    {
        return Expense::find($id);
    }

    public function update(Request $request, $id)
    {


        try {
            $fields =  $request->validate([
            'createdDate' => 'date',
            'expenseCost' => 'numeric',
            'expenseFor' => 'string',
            'status' => 'required',
            'expenseType_id' => 'exists:expense_types,id'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'errors' => $th->errors(),
            ], 422);
        }


        try {
            // Validate the value...
            $expense = Expense::find($id);
            $expense->update($request->all());
            return $expense;
        } catch (Throwable $e) {
            return $e;
        }
    }

    public function destroy($id)
    {

        try {
            // Validate the value...
            return  Expense::find($id)->delete();
        } catch (Throwable $e) {

            return $e;
        }
    }
    
    public function getChartData() {
        $user_id = auth()->user()->id;
        $year = now()->format('Y');
        $month = now()->format('m');
        
    
        $expensesForMonth = Expense::where('user_id', $user_id)->whereBetween('createdDate', [$year.'-01-01', $year.'-12-31'])->where('status', 'Approved')->get(['createdDate','expenseCost']);
        
        $expensesForWeek = Expense::where('user_id', $user_id)->whereBetween('createdDate', [$year.'-' .$month .'-01', $year.'-' .$month . '-31'])
        ->where('status', 'Approved')->get(['createdDate','expenseCost']);
        
        
        return response()->json([
            'month' => $expensesForMonth,
            'week' => $expensesForWeek
        ]);
    }
}
