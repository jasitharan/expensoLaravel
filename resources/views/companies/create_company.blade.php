@extends('companies.companies')
@section('companies-create-active','active')
@section('edit-hidden','d-none')

@section('companies-section')
    
<div class="card-body">
  
   <form action="{{ url('companies') }}" method="post" name="companies-create-form" enctype="multipart/form-data">
    @csrf
    <div>
      <h5 class="card-title mt-4">Name</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="name" name="name">
        <div id="nameHelp" class="form-text">
          Insert Name
          </div>
      </div>
    </div>
    
    <div>
      <h5 class="card-title mt-4">Address</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="address" name="address">
        <div id="addressHelp" class="form-text">
          Insert Address
          </div>
      </div>
    </div>
    
    
    <div>
      <h5 class="card-title mt-4">City</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="city" name="city">
        <div id="cityHelp" class="form-text">
          Insert City
          </div>
      </div>
    </div>
    
    
    <div>
      <h5 class="card-title mt-4">Province</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="province" name="province">
        <div id="provinceHelp" class="form-text">
          Insert Province
          </div>
      </div>
    </div>
    
    <div>
      <h5 class="card-title mt-4">Country</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="country" name="country">
        <div id="countryHelp" class="form-text">
          Insert Country
          </div>
      </div>
    </div>


      <div class="text-end">
        <a href="javascript: createCompany()" class="btn btn-primary ">Save</a>
      </div>
    </form>
</div>
  
  



@endsection
