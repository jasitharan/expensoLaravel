<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseType;
use Carbon\Carbon;


class ExpenseTypeController extends Controller
{
    public function index()
    {
        return ExpenseType::all()->sortByDesc('created_at')->values();
    }

    public function store(Request $request)
    {
        $request->validate([
            'expType' => 'required',
            'expCostLimit' => 'required',
        ]);

        $modifiedBy = auth()->user()->name;


        return ExpenseType::create([
            'expType' => $request->expType,
            'expCostLimit' => $request->expCostLimit,
            'createdDate' => Carbon::now(),
            'updatedDate' => Carbon::now(),
            'modifedBy' => $modifiedBy
        ]);
    }

    public function show($id)
    {
        return ExpenseType::find($id);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'expType' => 'string',
            'expCostLimit' => 'numeric'
        ]);


        try {
            // Validate the value...
            $expenseType = ExpenseType::find($id);
            $expenseType->update($request->all());
            return $expenseType;
        } catch (Throwable $e) {
            return $e;
        }
    }

    public function destroy($id)
    {

        try {
            // Validate the value...
            return  ExpenseType::find($id)->delete();
        } catch (Throwable $e) {

            return $e;
        }
    }
}
