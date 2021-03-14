@extends('master.add-post')

  @section('Post_id')

    <div class="col-12"> <div class="page-title-box"> <div class="page-title-right">
      <ol class="breadcrumb m-0"><li class="breadcrumb-item">
      Filmoq</li> <li class="breadcrumb-item"><a href="javascript: void(0);">Season</a></li>
       <li class="breadcrumb-item active"><a href="javascript: void(0);">Add Season</a></li>
     </ol> </div>
      <h4 class="page-title" >ADD Season</h4> </div> </div>

      <form action="{{ url('/admincp/movies/add/save') }}" enctype="multipart/form-data" method="post">

    <div class="row">
    @csrf
    <div class="col-lg-8 col-sm-12">

      <div class="py-1 mb-0">
     <input type="text" id="simpleinput" name="addTiltle" class="form-control" placeholder="ADD Title">
    </div>
    <div class="py-0 mb-0">
    <textarea name="editor">
      <h1>بسم الله</h1>
    </textarea> </div>
       <!-- end Snow-editor-->
       <div class="card py-2">
     <div class="card-header bg-blue py-2 text-white">
     <div class="card-widgets">
     <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
     <a data-toggle="collapse" href="#Data" role="button" aria-expanded="false" aria-controls="Data"><i class="mdi mdi-minus"></i></a>

     </div>
     <h5 class="card-title mb-0 text-white">Data</h5>
     </div>
     <div id="Data" class="collapse show">

       <div class="row">
       <div class="col-6 py-1 mb-0">
         <input type="text" name="Title_tv_org" class="form-control" placeholder="title_tv_org">
       </div>
       <div class="col-6  py-1 mb-0">
         <input type="text" name="Status" class="form-control" placeholder="status">
       </div>


       <div class="col-6 py-1 mb-0">
         <input type="text" name="id_tmdb" class="form-control" placeholder="tmdb">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="text" name="id_imdb" class="form-control" placeholder="Imdb">
       </div>
      <div class="col-6 py-1 mb-0">
         <input type="text" name="Country" class="form-control" placeholder="country">
       </div>
       <div class="col-md-3 col-6  py-1 mb-0">
         <input type="text" name="Language" class="form-control" placeholder="language">
       </div>
       <div class="col-md-3 col-6 py-1 mb-0">
         <input type="text" name="LanguageOrg" class="form-control" placeholder="language org">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="text" name="Video" class="form-control" placeholder="video">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="text" name="Adult" class="form-control" placeholder="adult">
       </div>
       <div class="col-lg-6 col-md-6 col-6  py-1 mb-0">
         <div class="form-group row">
       <label for="example-input-normal" class="col-4 col-form-label d-none d-md-block"
       >first_date</label>
       <div class="col-md-8 col-12">
       <input type="date" name="FirstDate" class="form-control" placeholder="first_date">
       </div></div></div>
       <div class="col-md-6 col-6 py-1 mb-0">
         <input type="text" name="Timeep" class="form-control" placeholder="timeep">
       </div>
       <div class="col-md-4 col-6 py-1 mb-0">
         <input type="text" name="Rating" class="form-control" placeholder="rating">
       </div>
       <div class="col-md-4 col-6 py-1 mb-0">
       <input type="text" name="Popular" class="form-control" placeholder="popular">
       </div>
      <div class="col-md-4 col-6 py-1 mb-0">
      <input type="text" name="VoteCount" class="form-control" placeholder="vote_count">
      </div>



            <!-- end data-->
           </div>


     </div>
     </div> <!-- end card-->

     </div>


    <div class="col-lg-4 col-sm-12">

      <!-- Portlet card -->
                                    <div class="card">
    <div class="card-header bg-blue py-2 text-white">
    <div class="card-widgets">
    <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
    <a data-toggle="collapse" href="#Tags" role="button" aria-expanded="false" aria-controls="Tags"><i class="mdi mdi-minus"></i></a>

    </div>
    <h5 class="card-title mb-0 text-white">ADD Tags</h5>
    </div>


    <div id="Tags" class="collapse show">

      <div class="selectize-control multi py-1 ">
    <input class="form-control" type="text" id="selectize-tags" name="Tags"  value="{{-- @foreach ($Categorys->where('taxonomy', 'tags') as $key => $value)
@if (strlen($value->name)>= 4){{preg_replace("/\s+/", "", $value->name.",")}}

@endif
    @endforeach  --}}">
    </div>
    </div>
    </div> <!-- end card-->
    <!-- Portlet card -->
                                  <div class="card">
    <div class="card-header bg-blue py-2 text-white">
    <div class="card-widgets">
    <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
    <a data-toggle="collapse" href="#Category" role="button" aria-expanded="false" aria-controls="Category"><i class="mdi mdi-minus"></i></a>

    </div>
    <h5 class="card-title mb-0 text-white">ADD Category</h5>
    </div>
    <div id="Category" class="collapse show">
    <select class="custom-select " name="category">
    @foreach ($Categorys->where('taxonomy', 'Categorys')->all() as $key => $value)
      <option value="{{$value->id}}">{{$value->name}}</option>
    @endforeach
    {{-- <option selected="">Open this select menu</option> --}}
    </select>
    </div>
    </div> <!-- end card-->
    <div class="card">
<div class="card-header bg-blue py-2 text-white">
<div class="card-widgets">
<a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
<a data-toggle="collapse" href="#Quality" role="button" aria-expanded="false" aria-controls="Category"><i class="mdi mdi-minus"></i></a>

</div>
<h5 class="card-title mb-0 text-white">ADD Quality</h5>
</div>
<div id="Quality" class="collapse show">
<select class="custom-select " name="quality">
@foreach ($Categorys->where('taxonomy', 'Quality')->all() as $key => $value)
<option value="{{$value->id}}">{{$value->name}}</option>
@endforeach
{{-- <option selected="">Open this select menu</option> --}}
</select>
</div>
</div> <!-- end card-->
    <div class="card">
    <div class="card-header bg-blue py-2 text-white">
    <div class="card-widgets">
    <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
    <a data-toggle="collapse" href="#addPhoto" role="button" aria-expanded="false" aria-controls="addPhoto"><i class="mdi mdi-minus"></i></a>

    </div>
    <h5 class="card-title mb-0 text-white">ADD Photo</h5>
    </div>
    <div id="addPhoto" class="collapse show">
    <input type="file" name="addPhoto" data-plugins="dropify" data-max-file-size="1M" />

    </div>
    </div> <!-- end card-->

      <div class="card">
    <div class="card-header bg-blue py-2 text-white">
    <div class="card-widgets">
    <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
    <a data-toggle="collapse" href="#Save" role="button" aria-expanded="false" aria-controls="Save"><i class="mdi mdi-minus"></i></a>

    </div>
    <h5 class="card-title mb-0 text-white">Save</h5>
    </div>
    <div id="Save" class="collapse show">
      <div class="py-1 mb-0 text-white">
        <button  type="submit" value="data" name="Submit" class="btn btn-block btn--md btn-pink waves-effect waves-light">Save</button>
      </div>
    </div>
    </div> <!-- end card-->



    </div><!-- end col-->


    </div></form>
    <form action="{{ url('/admincp/movies/add/apiauto') }}" method="post">
      <div class="row">
          @csrf
          <div class="col-lg-8 col-12">
        <div class="card-header bg-blue py-2 text-white">
        <div class="card-widgets text-center">
        <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh text-center"></i></a>
        <a data-toggle="collapse" href="#rowtmdb" role="button" aria-expanded="false" aria-controls="rowtmdb"><i class="mdi mdi-minus text-center"></i></a>

        </div>
        <h5 class="card-title mb-0 text-white text-center">Import Data</h5>
        </div>
        <div id="rowtmdb" class="collapse show">

        <div class="row py-1">
        <div class="col-lg-6 col-sm-4">
           <input type="text" name="id_data" class="form-control" placeholder="tv id"> </div>
            <div class="col-lg-6 col-sm-4">
          <div class=" mb-0 text-white">
            <button  type="submit" value="AutoData" name="Submit" class="btn btn-block btn--md btn-pink waves-effect waves-light">Import</button>
          </div> </div>
        </div>
        </div>
        </div> <!-- end card-->

      </div>

        </form>

@endsection
