@extends('expenseTypes.expense_types')
@section('expense_types-edit-active','active')

@section('expense_types-section')
    
<div class="card-body">
  
    <form action="{{ url('expense_types/'.$expType->id) }}" method="post" name="expense_types-edit-form" enctype="multipart/form-data">
      <input name="_method" type="hidden" value="PUT">
      @csrf
      <div>
      <h5 class="card-title mt-4">Expense Type</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="expType" name="expType" value="{{$expType->expType}}">
        <div id="expTypeHelp" class="form-text">
          Insert expense type
          </div>
      </div>
    </div>

    <div>
      <h5 class="card-title mt-4">Expense Cost Limit</h5>
    
      <div class="mb-4 mt-3">
        <input type=number step=any class="form-control" id="expCostLimit" name="expCostLimit" value="{{$expType->expCostLimit}}">
        <div id="expCostLimitHelp" class="form-text">
          Insert expense cost limit
          </div>
      </div>
    </div>
        <div class="text-end">
          <a href="javascript: editExpenseType()" class="btn btn-primary ">Save</a>
        </div>
    </form>
  
   
  </div>



@endsection
