@extends('master.add-post')

  @section('Post_id')

    <div class="col-12"> <div class="page-title-box"> <div class="page-title-right">
      <ol class="breadcrumb m-0"><li class="breadcrumb-item">
      Filmoq</li> <li class="breadcrumb-item"><a href="javascript: void(0);">episode</a></li>
       <li class="breadcrumb-item active"><a href="javascript: void(0);">Add Season</a></li>
     </ol> </div>
      <h4 class="page-title" >ADD episode</h4> </div> </div>

      <form action="{{ url('/admincp/episodes') }}/{{$tv}}/{{$season->id}}/Add" enctype="multipart/form-data" method="post">

    <div class="row">
    @csrf
    <div class="col-lg-8 col-sm-12">

      <div class="py-1 mb-0">
     <input type="text" id="simpleinput" name="title_Add" class="form-control" placeholder="Title Full">
     <input type="text" id="simpleinput" name="title_episode" class="form-control" placeholder="name episode">
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
         <input type="text" name="title_season" class="form-control" placeholder="title_season" value="{{$season->name_season}}">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="text" name="title_tv" class="form-control" placeholder="title_tv" value="{{$season->name_tvshow}}">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="text" name="id_Tmdb" class="form-control" placeholder="id_Tmdb" value="{{$season->tmdb_id}}">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="text" name="nm_season" class="form-control" placeholder="nm_season" value="{{$season->season_nm}}">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="text" name="nm_episode" class="form-control" placeholder="nm_episode">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="date" name="DateFirst" class="form-control" placeholder="DateFirst">
       </div>




     <!-- end data-->
           </div>


     </div>
     </div> <!-- end card-->

     </div>


    <div class="col-lg-4 col-sm-12">
      <div class="card">
  <div class="card-header bg-blue py-2 text-white">
  <div class="card-widgets">
  <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
  <a data-toggle="collapse" href="#Category" role="button" aria-expanded="false" aria-controls="Category"><i class="mdi mdi-minus"></i></a>

  </div>
  <h5 class="card-title mb-0 text-white">ADD Quality</h5>
  </div>
  <div id="Quality" class="collapse show">
  <select class="custom-select " name="quality">
  @foreach ($Quality->where('taxonomy', 'Quality')->all() as $key => $value)
  <option value="{{$value->id}}">{{$value->name}}</option>
  @endforeach
  {{-- <option selected="">Open this select menu</option> --}}
  </select>
  </div>
  </div> <!-- end card-->
      <!-- Portlet card -->
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
      <form class="needs-validation was-validated" action="{{ url('/admincp/episodes/add/apiauto/') }}/{{ $tv }}/{{ $season->id	 }}" method="post">

      @csrf
      <div class="card py-2">
    <div class="card-header bg-blue py-2 text-white">
    <div class="card-widgets text-center">
    <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh text-center"></i></a>
    <a data-toggle="collapse" href="#rowtmdb" role="button" aria-expanded="false" aria-controls="rowtmdb"><i class="mdi mdi-minus text-center"></i></a>

    </div>
    <h5 class="card-title mb-0 text-white text-center">Import Data</h5>
    </div>
    <div id="rowtmdb" class="collapse show">

    <div class="row py-1">
    <div class="col-lg-3 col-sm-3">
       <input type="hidden" name="seasonid" value="{{ $season->id	 }}">
       <input type="text" class="form-control" placeholder="tv id" value="{{$season->tmdb_id}}" disabled> </div>
       <div class="col-lg-3 col-sm-3">
        <input type="text"  class="form-control" placeholder="nm season" value="{{$season->season_nm}}" disabled> </div>
         <div class="col-lg-3 col-sm-3">

        <input type="text" id="ep_data" name="ep_data" class="form-control" placeholder="nm episode" > </div>

      <div class="col-lg-3 col-sm-3">
    <div class=" mb-0 text-white">
      <button  type="submit" value="AutoData" name="Submit" class="btn btn-block btn--md btn-pink waves-effect waves-light">Import</button>
    </div> </div>

    </div>
    </div>
    </div> <!-- end card-->
    </form>

@endsection
