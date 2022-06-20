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
    
    <div>
      <h5 class="card-title mt-4">Address</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="address" name="address" value="{{$company->address->address}}">
        <div id="addressHelp" class="form-text">
          Insert Address
          </div>
      </div>
    </div>
    
    
    <div>
      <h5 class="card-title mt-4">City</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="city" name="city" value="{{$company->address->city}}">
        <div id="cityHelp" class="form-text">
          Insert City
          </div>
      </div>
    </div>
    
    
    <div>
      <h5 class="card-title mt-4">Province</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="province" name="province" value="{{$company->address->province}}">
        <div id="provinceHelp" class="form-text">
          Insert Province
          </div>
      </div>
    </div>
    
    <div>
      <h5 class="card-title mt-4">Country</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="country" name="country" value="{{$company->address->country}}">
        <div id="countryHelp" class="form-text">
          Insert Country
          </div>
      </div>
    </div>
  
        <div class="text-end">
          <a href="javascript: editCompany()" class="btn btn-primary ">Save</a>
        </div>
    </form>
  
   
  </div>



@endsection
