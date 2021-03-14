@extends('master.add-post')

  @section('Post_id')
  <div class="col-12"> <div class="page-title-box"> <div class="page-title-right">
    <ol class="breadcrumb m-0"><li class="breadcrumb-item">
    Filmoq</li> <li class="breadcrumb-item"><a href="javascript: void(0);">Season</a></li>
     <li class="breadcrumb-item active"><a href="javascript: void(0);">Add Season</a></li>
   </ol> </div>
    <h4 class="page-title" >ADD Season</h4> </div> </div>

    <form class="parsley-examples needs-validation was-validated" action="{{ url('/admincp/episodes/edit/') }}/{{ $Episode->sea_id	 }}/{{ $Episode->id	 }}" enctype="multipart/form-data" method="post" novalidate>

  <div class="row">
  {{ csrf_field() }}
  <div class="col-lg-8 col-sm-12">

    <div class="py-1 mb-0">
   <input type="text" id="simpleinput" name="title_Add" class="form-control" placeholder="ADD Title" value="{{ $Episode->name }}">
  </div>
  <div class="py-0 mb-0">
  <textarea name="editor" id="editor">
    {{ $Episode->overview }}
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
       <div class="col-12 py-1 mb-0">
         <div class="input-group py-1 mb-0">
           <label for="inputEmail3" class="col-3 col-form-label">Name Episode</label>

        <input type="text" id="simpleinput" name="title_episode" class="col-9 form-control" placeholder="ADD Title" value="{{ $Episode->name_episode }}">
       </div>
       </div>
      <div class="col-6 py-1 mb-0">
       <input type="text" name="title_season" class="form-control" placeholder="title_season" value="{{ $Episode->name_season	 }}">
     </div>
     <div class="col-6 py-1 mb-0">
       <input type="text" name="title_tv" class="form-control" placeholder="title_tv" value="{{ $Episode->name_tvshow	 }}">
     </div>
     <div class="col-6 py-1 mb-0">
       <input type="text" name="id_Tmdb" class="form-control" placeholder="id_Tmdb" value="{{ $Episode->tmdb_id	 }}">
     </div>
     <div class="col-3 py-1 mb-0">
       <input type="text" name="nm_season" class="form-control" placeholder="nm_season" value="{{ $Episode->season_nm	 }}">
     </div>
     <div class="col-3 py-1 mb-0">
       <input type="text" name="nm_episode" class="form-control" placeholder="nm_episode" value="{{ $Episode->episode_nm	 }}">
     </div>
     <div class="col-6 py-1 mb-0">
       <input type="date" name="DateFirst" class="form-control" placeholder="DateFirst" value="{{ $Episode->first_date	 }}">
      </div>



<div class="col-lg-12">

  <div class="card">
  <div class="card-header bg-blue py-2 text-white">
  <div class="card-widgets">
  <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
  <a data-toggle="collapse" href="#player" role="button" aria-expanded="false" aria-controls="player"><i class="mdi mdi-minus"></i></a>
  </div>
  <h5 class="card-title mb-0 text-white">Add Servers</h5>
  </div>
  <x-admin.servers :data="$Episode->server" type="episode" typeserver="player" />
    <x-admin.servers :data="$Episode->server" type="episode" typeserver="player_encodes" />
  </div>
  </div> <!-- end card-->


  <div class="col-lg-12">
    <div class="card">
    <div class="card-header bg-blue py-2 text-white">
    <div class="card-widgets">
    <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
    <a data-toggle="collapse" href="#download" role="button" aria-expanded="false" aria-controls="download"><i class="mdi mdi-minus"></i></a>

    </div>
    <h5 class="card-title mb-0 text-white">Add downloads</h5>
    </div>
    <x-admin.servers :data="$Episode->server" type="episode" typeserver="download" />
    <x-admin.servers :data="$Episode->server" type="episode" typeserver="download_encodes" />
    </div>
    </div> <!-- end card-->




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
  <a data-toggle="collapse" href="#Quality" role="button" aria-expanded="false" aria-controls="Category"><i class="mdi mdi-minus"></i></a>

  </div>
  <h5 class="card-title mb-0 text-white">ADD Quality</h5>
  </div>
  <div id="Quality" class="collapse show">
  <select class="custom-select " name="quality">
  @foreach ($Quality as $key => $value)
    @if (isset($Episode->Tags->where('taxonomy', 'Quality')->first()->Tags->name))

    @if ($Episode->Tags->where('taxonomy', 'Quality')->first()->Tags->name == $value->name)


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
  <input class="form-control" type="file" name="addPhoto" data-plugins="dropify" data-max-file-size="1M" data-allowed-file-extensions="jpg png svg" data-default-file="{{ url('storage/images') }}/{{ $Episode->post_img	 }}" />

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
<div class="row">
  <div class="col-md-8 col-12">
    <form class="needs-validation was-validated" action="{{ url('/admincp/episodes/add/apiauto/') }}/{{ $Episode->sea_id	 }}/{{ $Episode->id	 }}" method="post">
      {{ csrf_field() }}
      <div class="card py-2">
    <div class="card-header bg-blue py-2 text-white">
    <div class="card-widgets text-center">
    <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh text-center"></i></a>
    <a data-toggle="collapse" href="#rowtmdb" role="button" aria-expanded="false" aria-controls="rowtmdb"><i class="mdi mdi-minus text-center"></i></a>

    </div>
    <h5 class="card-title mb-0 text-white text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="rowtmdb">Import Data</h5>
    </div>
    <div id="rowtmdb" class="collapse show">

    <div class="row py-1">
    <div class="col-lg-3 col-sm-3">
      <input type="hidden" name="seasonid" value="{{ $Episode->sea_id	 }}">
      <input type="text" class="form-control" placeholder="tv id" value="{{ $Episode->tmdb_id	 }}" disabled>
    </div>
   <div class="col-lg-3 col-sm-3">
        <input type="text" class="form-control" placeholder="nm season" value="{{ $Episode->season_nm	 }}" disabled>
   </div>
   <div class="col-lg-3 col-sm-3">
       <input type="text" id="ep_data" name="ep_data" class="form-control" placeholder="nm episode" value="{{ $Episode->episode_nm	 }}" required>
   </div>
      <div class="col-lg-3 col-sm-3">
      <div class=" mb-0 text-white">
        <button  type="submit" value="AutoData" name="Submit" class="btn btn-block btn--md btn-pink waves-effect waves-light">Import</button>
      </div> </div>
   </div>
    </div>
    </div> <!-- end card-->
    </form>

  </div>
</div>
@endsection
