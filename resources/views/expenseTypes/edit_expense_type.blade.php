@extends('expenseTypes.expense_types')
@section('expense_types-edit-active','active')

@section('expense_types-section')
    
<div class="card-body">
  
    <form action="{{ url('expense_types/'.$category->id) }}" method="post" name="category-edit-form" enctype="multipart/form-data">
      <input name="_method" type="hidden" value="PUT">
      @csrf
      <div>
        <h5 class="card-title mt-4">Name</h5>
      
        <div class="mb-4 mt-3">
          <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
          <div id="titleHelp" class="form-text">
            Insert category name
            </div>
        </div>
      </div>
      
      <div class="mt-4 mb-4">
        <img height=60px width=60px src='{{ $category->url_image }}' class="rounded float-left" alt="news_image">
          <h5 class="card-title mt-2 mb-3">Image</h5>
          <input class="form-control" type="file" id="url_image" name="url_image">
        </div>
        <div class="text-end">
          <a href="javascript: editCategory()" class="btn btn-primary ">Save</a>
        </div>
    </form>
  
   
  </div>



@endsection
