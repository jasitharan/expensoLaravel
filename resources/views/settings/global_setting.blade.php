@extends('settings.settings')
@section('global-setting-active','active')



@section('setting-content')



<div class="card shadow-sm p-3 mb-5 bg-white rounded">
  <div class="card-header">
    Global Settings
</div>


<form action="{{ url('settings/global') }}" method="post" name="setting-global-form">
  <input name="_method" type="hidden" value="patch">
  @csrf
  <div class="card-body">
    
    <div>
      <h5 class="card-title mt-4">Application Name</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="app_name" name="app_name" value="{{ $settings->app_name }}">
        <div id="appNameHelp" class="form-text">
          Insert the application name
          </div>
      </div>
    </div>
    
    <div>
      <h5 class="card-title mt-4">Short Description</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="app_short_description" name="app_short_description" value="{{ $settings->app_short_description }}">
        <div id="shortDescriptionHelp" class="form-text">
          Insert the application short description
          </div>
      </div>
    </div>
    
    <div>
      <h5 class="card-title mt-4">Application Version</h5>
    
      <div class="mb-4 mt-3">
        <input type="text" class="form-control" id="app_version" name="app_version" value="{{ $settings->app_version }}">
        <div id="appVersionHelp" class="form-text">
          Insert the application version
          </div>
      </div>
    </div>
    
   
    
    <div class="text-end">
      <a href="javascript: saveSettingGlobal()" class="btn btn-primary ">Save</a>
    </div>
   
   
   
  </div>

</form>


</div>


@endsection

