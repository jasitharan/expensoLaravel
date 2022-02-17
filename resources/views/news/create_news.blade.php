@extends('news.news')
@section('news-create-active','active')
@section('edit-hidden','d-none')

    

@section('news-section')

<div class="card-body">
  
  <form action="{{ url('news') }}" method="post" name="news-create-form" enctype="multipart/form-data">
    @csrf
    <div class="container px-4">
      <div class="row gx-5">
        <div class="col">
            {{-- Title --}}
         <div>
          <h5 class="card-title mt-4">Title</h5>
          <input type="text" class="form-control" id="title" name="title">
          <div id="titleHelp" class="form-text">
             insert news title
            </div>
         </div>
          {{-- News Detail --}}
         <div>
          <h5 class="card-title mt-4">News Details</h5>
          <div class="mb-3">
              <textarea class="form-control" id="content" rows="6" name="content"></textarea>
            </div>
            <div id="contentHelp" class="form-text">
              insert news details
             </div>
         </div>
         
          {{-- Image --}}
         
          <div class="mt-3 mb-4">
              <h5 class="card-title mb-3">Image</h5>
              <input class="form-control" type="file" id="url_image" name="url_image">
              <div id="url_imageHelp" class="form-text">
                  insert the image
                 </div>
            </div>
            
       
        </div>
        <div class="col">
          <div class="mt-3">
              <h5 class="card-title mb-3">Category</h5>
<select class="form-select" aria-label="Default select example" name="category_name">
  <option selected value="">Open this select category</option>
  @if (count($categories) > 0)
  @foreach ($categories as $category)
  <option  value="{{ $category->name }}">{{ $category->name }}</option>
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
    <input class="form-check-input" type="radio" name="headline" id="headline" value="1">
    <label class="form-check-label" for="headline">
      yes
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="headline" id="headline" value="0" checked>
    <label class="form-check-label" for="headline" >
      no
    </label>
  </div>
 </div>
            
 <div>
  <h5 class="card-title mt-4">Status</h5>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="published" id="published" name="published" value="1" checked>
    <label class="form-check-label" for="published" >
      publish
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="published" id="published" value="0">
    <label class="form-check-label" for="published">
      unpublish
    </label>
  </div>
 </div>   
             
        </div>
      </div>
    </div>
 
    <div class="text-end mt-4">
      <a href="javascript: createNews()" class="btn btn-primary ">Save</a>
    </div>
  </form>

    
  </div>



@endsection
