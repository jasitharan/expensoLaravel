@extends('category.category')
@section('category-create-active','active')
@section('edit-hidden','d-none')

@section('category-section')
    
<div class="card-body">
  
   <form action="{{ url('category') }}" method="post" name="category-create-form" enctype="multipart/form-data">
    @csrf
    <div>
      <h5 class="card-title mt-4">Name</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="name" name="name">
        <div id="nameHelp" class="form-text">
          Insert category name
          </div>
      </div>
    </div>
    
    <div class="mt-3 mb-4">
        <h5 class="card-title mb-3">Image</h5>
        <input class="form-control" type="file" id="url_image" name="url_image">
      </div>
      <div class="text-end">
        <a href="javascript: createCategory()" class="btn btn-primary ">Save</a>
      </div>
    </form>
</div>
  
  



@endsection
