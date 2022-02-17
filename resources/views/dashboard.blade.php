@extends('layouts.master')
@section('title','Dashboard')
@section('dashboard-active','active')

@section('content')


<div class="dashboard_cardview">
    
    <div class="cardview">
        <div class="card shadow-sm p-3 mb-5 bg-info rounded  bg-info text-dark mb-3" style="max-width: 18rem;">
            <div class="card-body">
               
                    <i class='bx bxs-user mb-3' style="font-size:32px"></i>
            
                
                    <h5 class="card-title">Total Users</h5>
              <p class="card-text">Registerd User
            </p>
            <h2 class="card-title">{{ $total_users }}</h2>
              
            </div>
          </div>
    </div>
    
    <div class="cardview">
        <div class="card shadow-sm p-3 mb-5 bg-info rounded text-dark bg-info mb-3" style="max-width: 18rem;">
            <div class="card-body">
               
                    <i class='bx bxs-news mb-3' style="font-size:32px"></i>
              
                
                    <h5 class="card-title">Total News</h5>
              <p class="card-text">published into App
            </p>
            <h2 class="card-title">{{ $total_news }}</h2>
              
            </div>
          </div>
    </div>
    
    
    <div class="cardview">
        <div class="card shadow-sm p-3 mb-5 bg-info rounded text-dark bg-info mb-3" style="max-width: 18rem;">
            <div class="card-body">
               
                    <i class='bx bxs-folder mb-3' style="font-size:32px"></i>
              
                
                    <h5 class="card-title">Total Categories</h5>
              <p class="card-text">Active Categories
            </p>
            <h2 class="card-title">{{ $total_categories }}</h2>
              
            </div>
          </div>
    </div>
    
    <div class="cardview">
        <div class="card shadow-sm p-3 mb-5 bg-info rounded text-dark bg-info mb-3" style="max-width: 18rem;">
            <div class="card-body">
               
                    <i class='bx bxs-comment-detail mb-3' style="font-size:32px"></i>
              
                
                    <h5 class="card-title">Total Comments</h5>
              <p class="card-text">posted at
            </p>
            <h2 class="card-title">{{ $total_comments }}</h2>
              
            </div>
          </div>
    </div>
    
  
   
</div>


<div class="card shadow-sm p-3 mb-5 bg-white rounded">
    <h5 class="card-header">Recent 5 News</h5>
    <div class="card-body">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>News Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
                @if (count($news) > 0)
                   @foreach ($news as $n)
                   <tr class="align-middle">
                    <td>
                        <img class="rounded-circle" alt="50x50" width="60px" height="60px" src="{{ $n->url_image  }}" data-holder-rendered="true">
                    </td>
                    <td>{{ $n->title }}</td>
                    <td>
                        
                        <a href="{{ url('news/'.$n->id.'/edit') }}" class="btn btn-link text-center">
                            <i class="fa fa-edit"></i>
                        </a>
                      
                    </td>
                </tr>
                   @endforeach
                @endif
                
                
           </tbody>
        </table>
    </div>
  </div>


@endsection