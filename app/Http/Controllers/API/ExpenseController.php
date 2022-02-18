<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;


class ExpenseController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        return Expense::where('user_id', $user_id)->get()->sortByDesc('created_at')->values();
    }

    public function store(Request $request)
    {
        try {
            $fields =  $request->validate([
                'createdDate' => 'date',
                'receiptPath' => 'string',
                'expenseCost' => 'required|numeric',
                'expenseFor' => 'string',
                'otherExpense' => 'string',
                'rentalAgency' => 'string',
                'carClass' => 'string',
                'ticketNo' => 'string',
                'airline' => 'string',
                'daysInHotel' => 'integer',
                'hotelName' => 'string',
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
                'createdDate' => $request->get('createdDate'),
                'receiptPath' =>  $request->get('receiptPath'),
                'expenseCost' => $request->get('expenseCost'),
                'expenseFor' => $request->get('expenseFor'),
                'otherExpense' => $request->get('otherExpense'),
                'rentalAgency' => $request->get('rentalAgency'),
                'carClass' => $request->get('carClass'),
                'ticketNo' => $request->get('ticketNo'),
                'airline' => $request->get('airline'),
                'daysInHotel' => $request->get('daysInHotel'),
                'hotelName' => $request->get('hotelName'),
                'expenseType_id' => $request->get('expenseType_id'),
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
            'receiptPath' => 'string',
            'expenseCost' => 'numeric',
            'expenseFor' => 'string',
            'otherExpense' => 'string',
            'rentalAgency' => 'string',
            'carClass' => 'string',
            'ticketNo' => 'string',
            'airline' => 'string',
            'daysInHotel' => 'integer',
            'hotelName' => 'string',
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
}
