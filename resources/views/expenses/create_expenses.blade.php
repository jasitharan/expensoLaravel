@extends('expenses.expenses')
@section('expense-create-active','active')
@section('edit-hidden','d-none')

    

@section('expense-section')

<div class="card-body">
  
  <form action="{{ url('expenses') }}" method="post" name="expenses-create-form" enctype="multipart/form-data">
    @csrf
    <div class="container px-4">
      <div class="row gx-5">
        <div class="col">
            {{-- Expense For --}}
         <div>
          <h5 class="card-title mt-4">Expense For</h5>
          <input type="text" class="form-control" id="expenseFor" name="expenseFor">
          <div id="expenseForHelp" class="form-text">
             insert Expense For
            </div>
         </div>

         {{-- Expense Type --}}
         <div class="mt-3">
              <h5 class="card-title mb-3">Expense Type</h5>
            <select class="form-select" aria-label="Default select example" name="expenseType_id">
              <option selected value="">Open this select expense type</option>
                          @if (count($expense_types) > 0)
              @foreach ($expense_types as $expense_type)
              <option  value="{{ $expense_type->id }}">{{ $expense_type->expType }}</option>
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
          <input type=number step=any class="form-control" id="expenseCost" name="expenseCost">
          <div id="expenseCostHelp" class="form-text">
             insert Expense Cost
            </div>
         </div>
            
       
        </div>
        <div class="col">
          <div class="mt-3">
              <h5 class="card-title mb-3">User</h5>
            <select class="form-select" aria-label="Default select example" id='user_id' name="user_id">
              <option selected value="">Open this select user</option>
                          @if (count($users) > 0)
              @foreach ($users as $user)
              <option  value="{{ $user->id }}">{{ $user->name }}</option>
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
          <input type=date class="form-control" id="createdDate" name="createdDate">
          <div id="createdDateHelp" class="form-text">
             select created date
            </div>
         </div>
            

            
 <div>
  <h5 class="card-title mt-4">Status</h5>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="status"  value="Unknown" checked>
    <label class="form-check-label" for="status" >
      Unknown
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="status" value="Approved">
    <label class="form-check-label" for="status">
      Approve
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="status" id="status" value="Rejected">
    <label class="form-check-label" for="status">
      Reject
    </label>
  </div>
 </div>   
             
        </div>
      </div>
    </div>
 
    <div class="text-end mt-4">
      <a href="javascript: createExpense()" class="btn btn-primary ">Save</a>
    </div>
  </form>

    
  </div>



@endsection
