@extends('news.news')
@section('news-edit-active','active')

    

@section('news-section')

<div class="card-body">

  <form action="{{ url('news/'.$news->id) }}" method="post" name="news-edit-form" enctype="multipart/form-data">
    <input name="_method" type="hidden" value="PUT">
    @csrf
  
    <div class="container px-4">
      <div class="row gx-5">
        <div class="col">
            {{-- Title --}}
         <div>
          <h5 class="card-title mt-4">Title</h5>
          <input type="text" class="form-control" id="title" name="title" value="{{ $news->title }}">
          <div id="titleHelp" class="form-text">
             insert news title
            </div>
         </div>
          {{-- News Detail --}}
         <div>
          <h5 class="card-title mt-4">News Details</h5>
          <div class="mb-3">
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="6" name="content">{{ $news->content }}</textarea>
            </div>
            <div id="notificationHelp" class="form-text">
              insert news details
             </div>
         </div>
         
          {{-- Image --}}
         
          <div class="mt-4 mb-4">
            <img height=60px width=60px src='{{ $news->url_image }}' class="rounded float-left" alt="news_image">  
              <h5 class="card-title mt-2 mb-3">Image</h5>
              <input class="form-control" type="file" id="url_image"  name="url_image">
              <div id="url_imageHelp" class="form-text">
                  insert the image
                 </div>
               
            </div>
            
       
        </div>
        <div class="col">
          <div class="mt-3">
              <h5 class="card-title mb-3">Category</h5>
<select class="form-select" aria-label="Default select example" name="category_name">
  <option value="">Open this select category</option>
  
  @if (count($categories) > 0)
    @foreach ($categories as $category)
    @if (($category->name == $news->category_name))
    <option selected value="{{ $category->name }}">{{ $category->name }}</option>
    @else
    <option value="{{ $category->name }}">{{ $category->name }}</option>
    @endif
  
    @endforeach
  @endif
  
  

</select>

<div id="newsHelp" class="form-text">
  select category
 </div>
</div>
{{-- divide --}}
<div>
  <h5 class="card-title mt-4">Headline</h5>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="headline" id="headline"  value="1" {{ $news->headline == 1 ? 'checked="checked"' : '' }}>
    <label class="form-check-label" for="headline" >
      yes
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="headline" id="headline" value="0" {{ $news->headline != 1 ? 'checked="checked"' : '' }}>
    <label class="form-check-label" for="headline">
      no
    </label>
  </div>
 </div>
            
 <div>
  <h5 class="card-title mt-4">Status</h5>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="published" id="published" value="1" {{ $news->published == 1 ? 'checked="checked"' : '' }}>
    <label class="form-check-label" for="published">
      publish
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="published" id="published" value="0" {{ $news->published != 1 ? 'checked="checked"' : '' }}>
    <label class="form-check-label" for="published">
      unpublish
    </label>
  </div>
 </div>   
             
        </div>
      </div>
    </div>
 
    <div class="text-end mt-4">
      <a href="javascript: editNews()" class="btn btn-primary ">Save</a>
    </div>
  
  </form>
  </div>



@endsection
