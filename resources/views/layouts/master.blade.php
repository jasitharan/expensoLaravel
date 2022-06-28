<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel = "icon" href = 
    "{{ asset('images/logo.png') }}" 
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
                         <i class='emojione:letter-e'></i> 
                         <!-- <i class='bx bx-letter-n nav_logo-icon'></i> -->
                         <span class="nav_logo-name">EXPENSO</span> 
                        </a>
                 
                <div class="nav_list"> 
                    <a href="{{ url('dashboard') }}" class="nav_link @yield('dashboard-active')"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a> 

                    <a href="{{ url('pending_expenses?sort=created_at&direction=desc') }}" class="nav_link @yield('pending_expenses-active')"> <i class='bx bx-time nav_icon'></i> <span class="nav_name">Pending Expenses</span> </a> 
                    
                    <a href="{{ url('companies?sort=created_at&direction=desc') }}" class="nav_link @yield('companies-active')"> <i class='bx bx-building nav_icon'></i> <span class="nav_name">Companies</span> </a>
                    
                    @if (Auth::user()->role == 'admin')
                    <a href="{{ url('users?sort=created_at&direction=desc') }}" class="nav_link @yield('users-active')"> <i class='bx bx-user nav_icon'></i> <span class="nav_name">Users</span> </a>
                    @endif
                    
                    <a href="{{ url('expenses?sort=created_at&direction=desc') }}" class="nav_link @yield('expense-active')"><i class='bx bx-money nav_icon'></i> <span class="nav_name">Expenses</span> </a> 
                    
                    <a href="{{ url('expense_types?sort=created_at&direction=desc') }}" class="nav_link @yield('expense_types-active')"> <i class='bx bx-wallet nav_icon'></i> <span class="nav_name">ExpenseTypes</span> </a> 
                      
                    
                    @if (Auth::user()->role == 'admin')
                   
                    <a href="{{ url('settings/global') }}" class="nav_link @yield('settings-active')"> <i class='bx bx-cog nav_icon'></i> <span class="nav_name">Settings</span> </a>
                    @endif
                   
            
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