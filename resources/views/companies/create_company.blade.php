@extends('companies.companies')
@section('companies-create-active','active')
@section('edit-hidden','d-none')

@section('companies-section')
    
<div class="card-body">
  
   <form action="{{ url('companies') }}" method="post" name="companies-create-form" enctype="multipart/form-data">
    @csrf
    <div>
      <h5 class="card-title mt-4">Company</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="name" name="name">
        <div id="nameHelp" class="form-text">
          Insert Name
          </div>
      </div>
    </div>


      <div class="text-end">
        <a href="javascript: createCompany()" class="btn btn-primary ">Save</a>
      </div>
    </form>
</div>
  
  



@endsection
