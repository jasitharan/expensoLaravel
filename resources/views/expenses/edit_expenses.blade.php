@extends('expenses.expenses')
@section('expense-edit-active','active')

    

@section('expense-section')

<div class="card-body">

  <form action="{{ url('expenses/'.$expense->id) }}" method="post" name="expenses-edit-form" enctype="multipart/form-data">
    <input name="_method" type="hidden" value="PUT">
    @csrf
  
    <div class="container px-4">
      <div class="row gx-5">
        <div class="col">
            {{-- Expense For --}}
         <div>
          <h5 class="card-title mt-4">Expense For</h5>
          <input type="text" class="form-control" id="expenseFor" name="expenseFor" value="{{$expense->expenseFor}}">
          <div id="expenseForHelp" class="form-text">
             insert Expense For
            </div>
         </div>

         {{-- Expense Type --}}
         <div class="mt-3">
              <h5 class="card-title mb-3">Expense Type</h5>
            <select class="form-select" aria-label="Default select example" name="expenseType_id">
              @if (count($expense_types) > 0)
              @foreach ($expense_types as $expense_type)

              @if (($expense_type->expType == $expense->expenseType_name))
              <option selected value="{{ $expense_type->id }}">{{ $expense_type->expType }}</option>
              @else
              <option  value="{{ $expense_type->id }}">{{ $expense_type->expType }}</option>
              @endif
              @endforeach
              @endif
            </select>

            <div id="expenseTypeHelp" class="form-text">
              select expense type
             </div>
         </div>
          
         
         {{-- Expense Cost --}}
         <div>
          <h5 class="card-title mt-4">Expense Cost</h5>
          <input type=number step=any class="form-control" id="expenseCost" name="expenseCost" value="{{$expense->expenseCost}}">
          <div id="expenseCostHelp" class="form-text">
             insert Expense Cost
            </div>
         </div>
            
       
        </div>
        <div class="col">
          <div class="mt-3">
              <h5 class="card-title mb-3">User</h5>
            <select class="form-select" aria-label="Default select example" id='user_id' name="user_id">
                          @if (count($users) > 0)
              @foreach ($users as $user)
              @if (($user->id == $expense->user_id))
              <option selected value="{{ $user->id }}">{{ $user->name }}</option>
              @else
              <option  value="{{ $user->id }}">{{ $user->name }}</option>
              @endif
              @endforeach
              @endif
            </select>

      <div id="userHelp" class="form-text">
        select user
      </div>
       </div>
{{-- divide --}}

      <div>
        <h5 class="card-title mt-4">Created Date</h5>
          <input type=date class="form-control" id="createdDate" name="createdDate" value="{{$expense->createdDate}}">
          <div id="createdDateHelp" class="form-text">
             select created date
            </div>
         </div>
            

            
 <div>
  <h5 class="card-title mt-4">Status</h5>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="status"  value="Unknown" {{ $expense->status == "Unknown" ? 'checked="checked"' : '' }}>
    <label class="form-check-label" for="status" >
      Unknown
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="status" value="Approved" {{ $expense->status == "Approved" ? 'checked="checked"' : '' }}>
    <label class="form-check-label" for="status">
      Approve
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="status" value="Rejected" {{ $expense->status == "Rejected" ? 'checked="checked"' : '' }}>
    <label class="form-check-label" for="status">
      Reject
    </label>
  </div>
 </div>   
             
        </div>
      </div>
    </div>
 
    <div class="text-end mt-4">
      <a href="javascript: editExpense()" class="btn btn-primary ">Save</a>
    </div>
  
  </form>
  </div>



@endsection
