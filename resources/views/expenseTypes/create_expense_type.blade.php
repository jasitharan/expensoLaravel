@extends('expenseTypes.expense_types')
@section('expense_types-create-active','active')
@section('edit-hidden','d-none')

@section('expense_types-section')
    
<div class="card-body">
  
   <form action="{{ url('expense_types') }}" method="post" name="expense_types-create-form" enctype="multipart/form-data">
    @csrf
    <div>
      <h5 class="card-title mt-4">Expense Type</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="expType" name="expType">
        <div id="expTypeHelp" class="form-text">
          Insert expense type
          </div>
      </div>
    </div>
    
    {{-- Image --}}
         
          <div class="mt-3 mb-4">
              <h5 class="card-title mb-3">Image</h5>
              <input class="form-control" type="file" id="url_image" name="url_image">
              <div id="url_imageHelp" class="form-text">
                  insert the image
                 </div>
            </div>

    <div>
      <h5 class="card-title mt-4">Expense Cost Limit</h5>
    
      <div class="mb-4 mt-3">
        <input type=number step=any class="form-control" id="expCostLimit" name="expCostLimit">
        <div id="expCostLimitHelp" class="form-text">
          Insert expense cost limit
          </div>
      </div>
    </div>
 
 


      <div class="text-end">
        <a href="javascript: createExpenseType()" class="btn btn-primary ">Save</a>
      </div>
    </form>
</div>
  
  



@endsection
