@extends('users.users')
@section('users-edit-active','active')

    

@section('users-section')

<div class="card-body">

  <form action="{{ url('users/'.$user->id) }}" method="post" name="users-edit-form" enctype="multipart/form-data">
    <input name="_method" type="hidden" value="PUT">
    @csrf
  
    <div class="container px-4">
      <div class="row gx-5">
        <div class="col">
            {{-- Name --}}
         <div>
          <h5 class="card-title mt-4">Name</h5>
          <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
          <div id="nameHelp" class="form-text">
             insert user name
            </div>
         </div>
         
         {{-- Email --}}
         <div>
          <h5 class="card-title mt-4">Email</h5>
          <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
          <div id="emailHelp" class="form-text">
             insert user email
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
            
       
            <div class="mt-3">
              <h5 class="card-title mb-3">Role</h5>
         <select class="form-select" aria-label="Default select example" name="category_name">
            <option  value="">Open this select roles</option>
            <option {{ $user->role == 'admin' ? "selected" : "" }} value="admin">Admin</option>
            <option {{ $user->role == 'employee' ? "selected" : "" }}  value="employee">Employee</option>
            <option {{ $user->role == 'supervisor' ? "selected" : "" }} value="supervisor">Supervisor</option>
            <option {{ $user->role == 'financial_manager' ? "selected" : "" }} value="financial_manager">Financial Manager</option>
</select>

<div id="newsHelp" class="form-text">
  select role
 </div>
</div>
        </div>
       
 
    <div class="text-end mt-4">
      <a href="javascript: editUser()" class="btn btn-primary ">Save</a>
    </div>
  
  </form>
  </div>



@endsection
