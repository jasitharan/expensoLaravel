@extends('expenses.expenses')
@section('expense-list-active','active')
@section('edit-hidden','d-none')

    

@section('expense-section')
<div class="card-body">
    
    <div class="d-flex flex-row justify-content-between">
        
      <div class="d-flex flex-row align-items-center">
        <div class="card-title text-center m-2"><h6 class="p-1 mt-2">Show</h6></div>
        <form action="{{ url('show_entries') }}" method="post" name="show-entries-form">
          <input name="_method" type="hidden" value="patch">
          @csrf
          <select class="form-select" aria-label="Default select example" id='expense-limit' name='expense-limit' onchange="javascript: submitEntries()">
            <option value="10" {{ $limit == 10? 'selected="selected"' : '' }}>10</option>
            <option value="25" {{ $limit == 25? 'selected="selected"' : '' }}>25</option>
            <option value="50" {{ $limit == 50? 'selected="selected"' : '' }}>50</option>
            <option value="100" {{ $limit == 100? 'selected="selected"' : '' }}>100</option>
          </select>
        </form>
       
        <div class="card-title text-center m-2"><h6 class="p-1 mt-2">Entries</h6></div>
    </div>
        
        <nav class="navbar navbar-light bg-light">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" id="search" value="{{ app('request')->input('search') }}" onchange="javascript: searchTable()">
          </nav>
        
        
    </div>
    
    <div class="m-4">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                 
                    <th>@sortablelink('user_name', 'User  ')</th>
                    <th>@sortablelink('expenseType_name', 'ExpenseType Name  ')</th>
                    <th>@sortablelink('expenseFor', 'Expense For  ')</th>
                    <th>@sortablelink('expenseCost', 'Expense Cost  ')</th>
                    <th>@sortablelink('createdDate', 'Created Date ')</th>
                    <th>@sortablelink('status', 'Status  ')</th>
                    <th>@sortablelink('created_at', 'Created At ')</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
               @if (count($expenses) > 0)
                 @foreach ($expenses as $expense)
                 <tr class="align-middle">
                    <td>{{ $expense->user_name }}</td>
                    <td>{{ $expense->expenseType->expType }}</td>
                    <td>{{ $expense->expenseFor }}</td>
                    <td>{{ $expense->expenseCost }}</td>
                    <td>{{ $expense->createdDate }}</td>
                    <td>{{ $expense->status }}</td>
                    <td>{{ $expense->created_at }}</td>
                    <td>
                        
                        <form method="POST" action="{{ url('expenses/'.$expense->id) }}" accept-charset="UTF-8">
                          <input name="_method" type="hidden" value="DELETE">
                          @csrf
                          <div class="btn-group">
                            
                            
                          
                              <a href="{{ url('expenses/'.$expense->id.'/edit') }}" class="btn btn-link text-center">
                                <i class="fa fa-edit"></i>
                            </a>
                  
                          
                          
                              <button type="submit" class="btn btn-link text-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                          </div>
                          </form>
                  
                    </td>
                </tr>
                     
                 @endforeach
               @endif
                     
           </tbody>
        </table>
    </div>
    
   
    
    <div class="d-flex flex-row justify-content-between">
        <div class="text-center m-2"><p>Showing {{ $expenses->count() }} of {{ $expenses->total() }} entries</p></div>
        <div class="d-flex justify-content-center">
        {!! $expenses->appends(Request::except('page'))->render() !!}
      </div>
    </div>
    
    

    
</div>
@endsection
