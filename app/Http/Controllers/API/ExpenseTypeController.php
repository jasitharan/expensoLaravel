<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpenseType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


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
            'expCostLimit' => 'required|numeric',
            'url_image' => 'image||nullable|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        $modifiedBy = auth()->user()->name;
        
        if ($request->hasFile('url_image')) {
            // Upload image
            $path = Storage::disk('public')->put('images/expense_type_images', $request->url_image);
        } else {
            $path = 'images/expense_type_images/noimage.jpg';
        }


        return ExpenseType::create([
            'expType' => $request->expType,
            'expCostLimit' => $request->expCostLimit,
            'createdDate' => Carbon::now(),
            'updatedDate' => Carbon::now(),
            'modifedBy' => $modifiedBy,
            'url_image' => Storage::url($path)
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
            'expCostLimit' => 'numeric',
            'url_image' => 'string'
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
