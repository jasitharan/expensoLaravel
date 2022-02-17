@extends('comments.comment')
@section('comment-create-active','active')
@section('edit-hidden','d-none')


@section('comment-section')
<div class="card-body">
  
    <form action="{{ url('comments') }}" method="post" name="comment-create-form">
      @csrf
     @csrf
     <div>
       <h5 class="card-title mt-4">Comment</h5>
     
       <div class="mb-4 mt-3">
         <input type="text" class="form-control" id="comment" name="comment">
         <div id="commentHelp" class="form-text">
           insert comment
           </div>
       </div>
     </div>
     
     
     <div class="mt-3">
      <h5 class="card-title mb-3">User</h5>
<select class="form-select" aria-label="Default select example" name="user_id">
<option value="">Open this select user</option>
@if (count($users) > 0)
@foreach ($users as $user)
<option value="{{ $user->id }}">{{ $user->name }} ({{ $user->id }})</option>
@endforeach
@endif
</select>

<div id="comment_user_Help" class="form-text">
select user
</div>
</div>

<div class="mt-3">
  <h5 class="card-title mb-3">News</h5>
<select class="form-select" aria-label="Default select example" name="news_id">
<option value="">Open this select news</option>
@if (count($news) > 0)
@foreach ($news as $n)
<option  value="{{ $n->id }}">{{ $n->title }} ({{ $n->id }})</option>
@endforeach
@endif
</select>

<div id="comment_news_Help" class="form-text">
select news
</div>
</div>
 
   
     
       <div class="text-end mt-2">
         <a href="javascript: createComment()" class="btn btn-primary ">Save</a>
       </div>
     </form>
 </div>

@endsection
