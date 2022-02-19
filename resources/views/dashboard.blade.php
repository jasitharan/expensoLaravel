@extends('layouts.master')
@section('title','Dashboard')
@section('dashboard-active','active')

@section('content')


<div class="dashboard_cardview">
    
    <div class="cardview">
        <div class="card shadow-sm p-3 mb-5 bg-info rounded  bg-info text-dark mb-3" style="max-width: 18rem;">
            <div class="card-body">
               
                    <i class='bx bxs-user mb-3' style="font-size:32px"></i>
            
                
                    <h5 class="card-title">Total Employee</h5>
              <p class="card-text">Registerd Employee
            </p>
            <h2 class="card-title">{{ $total_users }}</h2>
              
            </div>
          </div>
    </div>
    
    <div class="cardview">
        <div class="card shadow-sm p-3 mb-5 bg-info rounded text-dark bg-info mb-3" style="max-width: 18rem;">
            <div class="card-body">
               
                    <i class='bx bx-money mb-3' style="font-size:32px"></i>
              
                
                    <h5 class="card-title">Total Expenses</h5>
              <p class="card-text">Created Via Employee
            </p>
            <h2 class="card-title">{{ $total_expenses }}</h2>
              
            </div>
          </div>
    </div>
    
    
    <div class="cardview">
        <div class="card shadow-sm p-3 mb-5 bg-info rounded text-dark bg-info mb-3" style="max-width: 18rem;">
            <div class="card-body">
               
                    <i class='bx bxs-wallet mb-3' style="font-size:32px"></i>
              
                
                    <h5 class="card-title">Total ExpenseTypes</h5>
              <p class="card-text">Active ExpenseTypes
            </p>
            <h2 class="card-title">{{ $total_expenseTypes }}</h2>
              
            </div>
          </div>
    </div>
    
   
    
  
   
</div>


<div class="card shadow-sm p-3 mb-5 bg-white rounded">
    <h5 class="card-header">Recent 5 Expenses</h5>
    <div class="card-body">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Expense For</th>
                    <th>Expense Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
                @if (count($expenses) > 0)
                   @foreach ($expenses as $e)
                   <tr class="align-middle">
                    <td>
                    {{ $e->user_name }}
                    </td>
                    <td>{{ $e->expenseFor }}</td>
                    <td>{{ $e->expenseCost }}</td>
                    <td>
                        
                        <a href="{{ url('news/'.$e->id.'/edit') }}" class="btn btn-link text-center">
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