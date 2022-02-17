@extends('category.category')
@section('category-list-active','active')
@section('edit-hidden','d-none')



@section('category-section')


<div class="card-body">
    
    <div class="d-flex flex-row justify-content-between">
      
      
        
        <div class="d-flex flex-row align-items-center">
            <div class="card-title text-center m-2"><h6 class="p-1 mt-2">Show</h6></div>
            <form action="{{ url('show_entries') }}" method="post" name="show-entries-form">
              <input name="_method" type="hidden" value="patch">
              @csrf
              <select class="form-select" aria-label="Default select example" id='category-limit' name='category-limit' onchange="javascript: submitEntries()">
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
                    <th>
                      <div >Image</div>
                      </th>
                    <th>@sortablelink('name', 'Category Name  ')
                    </th>
                    <th>@sortablelink('created_at', 'Created  ')</th>
                  
                    <th><div>Actions</div></th>
                </tr>
            </thead>
            <tbody>
                
               @if (count($categories) > 0)
                 @foreach ($categories as $category)
                 <tr class="align-middle">
                    <td>
                        <img  alt="60x60" width="60px" height="60px" src="{{ $category->url_image }}">
                    </td>
                    <td>{{ $category->name }}</td>
                
                    <td>{{ $category->created_at }}</td>
                   
                    <td>
                      <form method="POST" action="{{ url('category/'.$category->name) }}" accept-charset="UTF-8">
                        <input name="_method" type="hidden" value="DELETE">
                        @csrf
                        <div class="btn-group">
                          
                          
                        
                            <a href="{{ url('category/'.$category->name.'/edit') }}" class="btn btn-link text-center">
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
      
        <div class="text-center m-2"><p>Showing {{ $categories->count() }} of {{ $categories->total() }} entries</p></div>
        <div class="d-flex justify-content-center">
          {!! $categories->appends(Request::except('page'))->render() !!}
      </div>
    </div>
    
    

    
</div>

@endsection
