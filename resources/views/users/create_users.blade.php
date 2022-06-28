@extends('users.users')
@section('users-create-active','active')
@section('edit-hidden','d-none')

    

@section('users-section')

<div class="card-body">
  
  <form action="{{ url('users') }}" method="post" name="users-create-form" enctype="multipart/form-data">
    @csrf
    <div class="container px-4">
      <div class="row gx-5">
        <div class="col">
            {{-- Name --}}
         <div>
          <h5 class="card-title mt-4">Name</h5>
          <input type="text" class="form-control" id="name" name="name">
          <div id="nameHelp" class="form-text">
             insert user name
            </div>
         </div>
         
         {{-- Email --}}
         <div>
          <h5 class="card-title mt-4">Email</h5>
          <input type="email" class="form-control" id="email" name="email">
          <div id="emailHelp" class="form-text">
             insert user email
            </div>
         </div>

         {{-- Password --}}
         <div>
          <h5 class="card-title mt-4">Password</h5>
          <input type="password" class="form-control" id="password" name="password">
          <div id="passwordHelp" class="form-text">
             insert user password
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
            
            
            {{-- Companies --}}
         <div class="mt-3">
              <h5 class="card-title mb-3">Company</h5>
            <select class="form-select" aria-label="Default select example" name="company_id">
              @if (count($companies) > 0)
              @foreach ($companies as $company)
              <option  value="{{ $company->id }}">{{ $company->name }}</option>
              @endforeach
              @endif
            </select>

            <div id="companyHelp" class="form-text">
              select company
             </div>
         </div>
            
       
            <div class="mt-3">
              <h5 class="card-title mb-3">Role</h5>
<select class="form-select" aria-label="Default select example" name="role">
  <option selected value="">Open this select roles</option>
  <option  value="admin">Admin</option>
  <option  value="employee">Employee</option>
  <option  value="financial_manager">Financial Manager</option>
</select>

<div id="exHelp" class="form-text">
  select role
 </div>
</div>
        </div>
       
 
    <div class="text-end mt-4">
      <a href="javascript: createUser()" class="btn btn-primary ">Save</a>
    </div>
  </form>

    
  </div>



@endsection
