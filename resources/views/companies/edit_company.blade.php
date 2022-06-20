@extends('companies.companies')
@section('companies-edit-active','active')

@section('companies-section')
    
<div class="card-body">
  
    <form action="{{ url('companies/'.$company->id) }}" method="post" name="companies-edit-form" enctype="multipart/form-data">
      <input name="_method" type="hidden" value="PUT">
      @csrf
      <div>
      <h5 class="card-title mt-4">Company</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="name" name="name" value="{{$company->name}}">
        <div id="nameHelp" class="form-text">
          Insert Name
          </div>
      </div>
    </div>
  
        <div class="text-end">
          <a href="javascript: editCompany()" class="btn btn-primary ">Save</a>
        </div>
    </form>
  
   
  </div>



@endsection
