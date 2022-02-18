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
        $request->validate([
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

        $user_id = auth()->user()->id;

        try {
            // Validate the value...
            return Expense::create([
                'user_id' => $user_id,
                'createdDate' => $request->createdDate,
                'receiptPath' => $request->receiptPath,
                'expenseCost' => $request->expenseCost,
                'expenseFor' => $request->expenseFor,
                'otherExpense' => $request->otherExpense,
                'rentalAgency' => $request->rentalAgency,
                'carClass' => $request->carClass,
                'ticketNo' => $request->ticketNo,
                'airline' => $request->airline,
                'daysInHotel' => $request->daysInHotel,
                'hotelName' => $request->hotelName,
                'expenseType_id' => $request->expenseType_id,
            ]);
        } catch (Throwable $e) {
            return $e;
        }

    }

    public function show($id)
    {
        return Expense::find($id);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
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
