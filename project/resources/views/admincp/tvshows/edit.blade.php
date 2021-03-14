@extends('master.add-post')

  @section('Post_id')

    <div class="col-12"> <div class="page-title-box"> <div class="page-title-right">
      <ol class="breadcrumb m-0"><li class="breadcrumb-item">
      Filmoq</li> <li class="breadcrumb-item"><a href="javascript: void(0);">Season</a></li>
       <li class="breadcrumb-item active"><a href="javascript: void(0);">Add Season</a></li>
     </ol> </div>
      <h4 class="page-title" >ADD Season</h4> </div> </div>

      <form action="{{ url('/admincp/tvshows/edit') }}/{{$tv->id}}" enctype="multipart/form-data" method="post">

    <div class="row">
    @csrf
    <div class="col-lg-8 col-sm-12">

      <div class="py-1 mb-0">
     <input type="text" id="simpleinput" name="addTiltle" class="form-control" placeholder="ADD Title" value="{{$tv->title}}">
    </div>
    <div class="py-0 mb-0">
    <textarea name="editor">
            {{$tv->content}}
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
         <input type="text" name="Title_tv_org" class="form-control" placeholder="title_tv_org" value="{{$tv->title_org}}">
       </div>
       <div class="col-6  py-1 mb-0">
         <input type="text" name="Status" class="form-control" placeholder="status" value="{{($Data->where('simokey', 'status')->first()->simovalue)??""}}">
       </div>


       <div class="col-6 py-1 mb-0">
         <input type="text" name="id_tmdb" class="form-control" placeholder="tmdb" value="{{$tv->tmdb_id}}">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="text" name="id_imdb" class="form-control" placeholder="Imdb" value="{{$tv->imdb_id}}">
       </div>
      <div class="col-6 py-1 mb-0">
         <input type="text" name="Country" class="form-control" placeholder="country" value="{{($Data->where('simokey', 'country')->first()->simovalue)??""}}">
       </div>
       <div class="col-md-3 col-6  py-1 mb-0">
         <input type="text" name="Language" class="form-control" placeholder="language" value="{{($Data->where('simokey', 'language')->first()->simovalue)??""}}">
       </div>
       <div class="col-md-3 col-6 py-1 mb-0">
         <input type="text" name="LanguageOrg" class="form-control" placeholder="language org" value="{{($Data->where('simokey', 'language_org')->first()->simovalue)??""}}">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="text" name="Video" class="form-control" placeholder="video" value="{{($Data->where('simokey', 'trailer')->first()->simovalue)??""}}">
       </div>

       <div class="col-6 py-1 mb-0">
         <input type="text" name="Network" class="form-control" placeholder="Network" value="{{($Data->where('simokey', 'networks')->first()->simovalue)??""}}">
       </div>
       <div class="col-md-4 col-6 py-1 mb-0">
         <input type="text" name="Timeep" class="form-control" placeholder="timeep" value="{{($Data->where('simokey', 'run_time')->first()->simovalue)??""}}">
       </div>
       <div class="col-md-4 col-6 py-1 mb-0">
       <input type="text" name="Ep_nm" class="form-control" placeholder="Ep_nm" value="{{($Data->where('simokey', 'episodes_nm')->first()->simovalue)??""}}">
       </div>
       <div class="col-md-4 col-6 py-1 mb-0">
       <input type="text" name="Sea_nm" class="form-control" placeholder="Sea_nm" value="{{($Data->where('simokey', 'seasons_nm')->first()->simovalue)??""}}">
       </div>
       <div class="col-md-4 col-6 py-1 mb-0">
         <input type="text" name="Rating" class="form-control" placeholder="rating" value="{{($Data->where('simokey', 'rating')->first()->simovalue)??""}}">
       </div>
       <div class="col-md-4 col-6 py-1 mb-0">
       <input type="text" name="VoteCount" class="form-control" placeholder="vote_count" value="{{($Data->where('simokey', 'vote_count')->first()->simovalue)??""}}">
       </div>
       <div class="col-md-4 col-6 py-1 mb-0">
       <input type="text" name="Popular" class="form-control" placeholder="popular" value="{{($Data->where('simokey', 'popular')->first()->simovalue)??""}}">
       </div>
      <div class="col-lg-6 col-md-6 col-6  py-1 mb-0">
        <div class="form-group row">
      <label for="example-input-normal" class="col-4 text-center col-form-label d-none d-md-block"
      >first_date</label>
      <div class="col-md-8 col-12">
      <input type="date" name="FirstDate" class="form-control" placeholder="first_date" value="{{($Data->where('simokey', 'first_date')->first()->simovalue)??""}}">
      </div></div></div>
      <div class="col-6">
        <div class="form-group row">
      <label for="example-input-normal" class="col-4 text-center col-form-label d-none d-md-block"
      >last_epdate</label>
      <div class="col-md-8 col-12">
      <input type="date" name="last_date" class="form-control" placeholder="last_epdate" value="{{($Data->where('simokey', 'last_date')->first()->simovalue)??""}}">
      </div></div></div>
<div class="col-6">
 <div class="form-group row">
<label for="example-input-normal" class="col-4 text-center col-form-label d-none d-md-block"
>next_ep</label>
<div class="col-md-8 col-12">
<input type="date" name="next_date_ep" class="form-control" placeholder="next_dateep" value="{{($Data->where('simokey', 'next_dateep')->first()->simovalue)??""}}">
</div></div></div>


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
        @if ($tv->Tags)
        @foreach ($tv->Tags->where('taxonomy', 'Tags')->all() as $key => $value)
        {{$value->Tags->firstWhere ('id', $value->cate_id)->name}},
      @endforeach
      @endif
      <br>
    <input class="form-control" type="text" id="selectize-tags" name="Tags"  value="">
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



  @foreach ($Categorys as $key => $value)
    @if (isset($tv->Tags->where('taxonomy', 'Categorys')->first()->Tags->name))

    @if ($tv->Tags->where('taxonomy', 'Categorys')->first()->Tags->name == $value->name)


      <option value="{{$value->id}}" selected>  {{$value->name}}</option>

    @else
        <option value="{{$value->id}}">  {{$value->name}}</option>
    @endif
  @else
  <option value="{{$value->id}}">  {{$value->name}}</option>
  @endif
  @endforeach

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
    <form action="{{ url('/admincp/tvshows/add/apiauto') }}" method="post">
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
