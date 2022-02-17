@extends('settings.settings')
@section('mail-setting-active','active')



@section('setting-content')

<div class="card shadow-sm p-3 mb-5 bg-white rounded">
    <div class="card-header">
      Mail Settings
  </div>
  
  <form action="{{ url('settings/mail') }}" method="post" name="setting-mail-form">
    <input name="_method" type="hidden" value="patch">
    @csrf
    <div class="card-body">

      <div class="container px-4">
          <div class="row gx-5">
            <div class="col">
             <div>
              <h5 class="card-title mt-4">Mail Mailer</h5>
              <input type="text" class="form-control" id="mail_mailer" name="mail_mailer" value="{{ $settings->mail_mailer }}">
              <div id="mailMailerHelp" class="form-text">
                 insert the mail mailer
                </div>
             </div>
             <div>
              <h5 class="card-title mt-4">Mail host</h5>
              <input type="text" class="form-control" id="mail_host" name="mail_host" value="{{ $settings->mail_host }}">
              <div id="mailHostHelp" class="form-text">
                 insert the mail host address
                </div>
             </div>
             <div>
              <h5 class="card-title mt-4">Mail Port</h5>
              <input type="text" class="form-control" id="mail_port" name="mail_port" value="{{ $settings->mail_port }}">
              <div id="mailPortHelp" class="form-text">
                 insert the mail port
                </div>
             </div>
             <div>
              <h5 class="card-title mt-4">Mail Username</h5>
              <input type="text" class="form-control" id="mail_username" name="mail_username" value="{{ $settings->mail_username }}">
              <div id="mailUsernameHelp" class="form-text">
                 insert the mail username
                </div>
             </div>
            </div>
            <div class="col">
              <div>
                  <h5 class="card-title mt-4">Mail Password</h5>
                  <input type="password" class="form-control" id="mail_password" name="mail_password" value="{{ $settings->mail_password }}">
                  <div id="mailPasswordHelp" class="form-text">
                     insert the mail password
                    </div>
                 </div>
                 <div>
                  <h5 class="card-title mt-4">Sender Email</h5>
                  <input type="text" class="form-control" id="mail_sender_mail" name="mail_sender_mail" value="{{ $settings->mail_sender_email }}">
                  <div id="mailSenderMailHelp" class="form-text">
                     insert the sender mail
                    </div>
                 </div>
                
                 <div>
                  <h5 class="card-title mt-4">Sender Name</h5>
                  <input type="text" class="form-control" id="mail_sender_name" name="mail_sender_name" value="{{ $settings->mail_sender_name }}">
                  <div id="mailSenderNameHelp" class="form-text">
                    insert the sender name
                    </div>
                 </div>
                 
                 <div>
                  <h5 class="card-title mt-4">Mail encryption</h5>
                  
                  
                  
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="mail_encryption" id="mail_encryption" value="tls" {{ $settings->mail_encryption == 'tls' ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="mail_encryption" >
                      TLS
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="mail_encryption" id="mail_encryption" value="ssl"  {{ $settings->mail_encryption == 'ssl' ? 'checked="checked"' : '' }}>
                    <label class="form-check-label" for="mail_encryption">
                      SSL
                    </label>
                  </div>
                 </div>
            </div>
          </div>
        </div>
     
        <div class="text-end mt-4">
          <a href="javascript: saveSettingMail()" class="btn btn-primary ">Save</a>
        </div>
    </div>
  </form>
  
 
  </div>


@endsection

