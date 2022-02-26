<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Login</title>
    <link rel = "icon" href = 
    "{{ asset('images/logo.png') }}" 
            type = "image/x-icon">
</head>

<body>
    


    <style>
        input[type='email'] {
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
        }

        input[type='password'] {
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
            border-top: 0px;
        }
        
    </style>
    
  
            <div class="text-center mt-5">
                
                <div class="p-4">
                    @include('inc.messages')
                </div>
              


                <form style="max-width: 380px;margin: auto;"  method="POST" action="/login">
                    
                   <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                    @csrf
                    <img class='mt-4 mb-4' src="{{ asset('images/logo.png') }}" alt="bootstrap logo" height="72">
                    <h1 class="h3 mb-3 font-weigh-normal">Please sign in</h1>
                    <label class="visually-hidden" for="emailAddress">Email address</label>
                    <input type="email" id="emailAddress" class="form-control" name="email" placeholder="Email Address" required autofocus>
                    <label class="visually-hidden" for="password">Password</label>
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password" required autofocus>
                    <div class="checkbox mt-3">
                        <label>
                            <input type="checkbox" name='remember-me' >
                            Remember me
                        </label>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-lg btn-primary btn-block">Sign In</button>
                    </div>
                </form>
        
            </div>
            
       

        
    </body>
    
    </html>


   