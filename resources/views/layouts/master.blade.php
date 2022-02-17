<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel = "icon" href = 
    "https://myflutternewsapp-images.s3.us-east-2.amazonaws.com/images/logo/logo.png" 
            type = "image/x-icon">
   
   @if(env('APP_ENV') == 'production')
   <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">
   @else
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   @endif

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    
     <!-- Place your kit's code here -->
     <script src="https://kit.fontawesome.com/d8015a7a20.js" crossorigin="anonymous"></script>

</head>
<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="text-primary"> <h2>@yield('title')</h2> </div>
        <div></div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <div>
                     <a href="{{ url('dashboard') }}" class="nav_logo"> 
                         <!-- <i class='bx bx-layer nav_logo-icon'></i>  -->
                         <i class='emojione:letter-n'></i> 
                         <!-- <i class='bx bx-letter-n nav_logo-icon'></i> -->
                         <span class="nav_logo-name">NEWSAPP</span> 
                        </a>
                 
                <div class="nav_list"> 
                    <a href="{{ url('dashboard') }}" class="nav_link @yield('dashboard-active')"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 
                    
                    <a href="{{ url('news?sort=created_at&direction=desc') }}" class="nav_link @yield('news-active')"> <i class='bx bx-news nav_icon'></i> <span class="nav_name">News</span> </a>
                    
                    <a href="{{ url('category?sort=created_at&direction=desc') }}" class="nav_link @yield('category-active')"><i class='bx bx-folder nav_icon'></i> <span class="nav_name">Categories</span> </a> 
                    
                    <a href="{{ url('comments?sort=created_at&direction=desc') }}" class="nav_link @yield('comments-active')"> <i class='bx bx-comment-detail nav_icon'></i> <span class="nav_name">Comments</span> </a> 
                    
                    <a href="{{ url('notifications') }}" class="nav_link @yield('notifications-active')"> <i class='bx bx-bell nav_icon'></i> <span class="nav_name">Notifications</span> </a> 
                    
                    <a href="{{ url('settings/global') }}" class="nav_link @yield('settings-active')"> <i class='bx bx-cog nav_icon'></i> <span class="nav_name">Settings</span> </a>
            
                </div>
                
                <form action="/logout" method="post" name="signOutForm" id="signOutForm">
                    @csrf
         
                        <a href="javascript: submitLogout()" class="nav_link" id="signout"> <i class='bx bx-log-out nav_icon'></i> <span class="nav_name">SignOut</span> </a>
         
                    
                </form>
               
            </div>
           
        </nav>
    </div>
    <!--Container Main start-->

   <div class="mt-5 pt-5"></div>

    <h2 class="mb-4"></h5>
       
    @include('inc.messages')

    @yield('content')

  
   
    <!--Container Main end-->
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>


    
    @if(env('APP_ENV') == 'production')
    <script src="{{ secure_asset('js/index.js') }}"></script>
    @else
    <script src="{{ asset('js/index.js') }}"></script>
    @endif

</html>