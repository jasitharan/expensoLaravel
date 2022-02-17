@extends('comments.comment')
@section('comment-list-active','active')
@section('edit-hidden','d-none')

@section('comment-section')
<div class="card-body">
    
    <div class="d-flex flex-row justify-content-between">
        
      <div class="d-flex flex-row align-items-center">
        <div class="card-title text-center m-2"><h6 class="p-1 mt-2">Show</h6></div>
        <form action="{{ url('show_entries') }}" method="post" name="show-entries-form">
          <input name="_method" type="hidden" value="patch">
          @csrf
          <select class="form-select" aria-label="Default select example" id='comment-limit' name='comment-limit' onchange="javascript: submitEntries()">
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
                    <th>@sortablelink('comment', 'Comment  ')</th>
                    <th>@sortablelink('news_id', 'News Title  ')</th>
                    <th>@sortablelink('user_id', 'User Name  ')</th>
                    <th>@sortablelink('created_at', 'Created  ')</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
               @if (count($comments) > 0)
                 @foreach ($comments as $comment)
                 <tr class="align-middle">
                    <td>{{ $comment->comment }}</td>
                    <td>{{ $comment->news_title }}</td>
                    <td>{{ $comment->user_name }}</td>
                    <td>{{ $comment->created_at }}</td>
                   
                    <td>
                        <form method="POST" action="{{ url('comments/'.$comment->id) }}" accept-charset="UTF-8">
                            <input name="_method" type="hidden" value="DELETE">
                            @csrf
                            <div class="btn-group">
                              
                              
                            
                                <a href="{{ url('comments/'.$comment->id.'/edit') }}" class="btn btn-link text-center">
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
        <div class="text-center m-2"><p>Showing {{ $comments->count() }} of {{ $comments->total() }} entries</p></div>
        <div class="d-flex justify-content-center">
          {!! $comments->appends(Request::except('page'))->render() !!}
      </div>
    </div>
    
    
  
    
  </div>
@endsection