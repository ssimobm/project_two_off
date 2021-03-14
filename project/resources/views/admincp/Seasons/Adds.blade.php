@extends('master.add-post')

  @section('Post_id')

    <div class="col-12"> <div class="page-title-box"> <div class="page-title-right">
      <ol class="breadcrumb m-0"><li class="breadcrumb-item">
      Filmoq</li> <li class="breadcrumb-item"><a href="javascript: void(0);">Season</a></li>
       <li class="breadcrumb-item active"><a href="javascript: void(0);">Add Season</a></li>
     </ol> </div>
      <h4 class="page-title" >ADD Season</h4> </div> </div>

      <form action="{{ url('/admincp/seasons') }}/{{$id}}/Add" enctype="multipart/form-data" method="post">

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
         <input type="text" name="title_season" class="form-control" placeholder="title_season">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="text" name="title_tv" class="form-control" placeholder="title_tv">
       </div>
       <div class="col-6">
         <input type="text" name="CountEp" class="form-control" placeholder="CountEp">
       </div>
       <div class="col-6">
         <input type="text" name="id_Tmdb" class="form-control" placeholder="id_Tmdb" value="{{$tv->tmdb_id }}">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="date" name="DateFirst" class="form-control" placeholder="DateFirst">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="text" name="NemSea" class="form-control" placeholder="NemSea">
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
    <form action="{{ url('/admincp/seasons/add/apiauto') }}/{{$id}}" method="post">
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

    <div class="col-lg-4 col-sm-4">
       <input type="text" name="tmdbid" class="form-control" placeholder="tv id" value="{{$tv->tmdb_id }}">
    </div>

    <div class="col-lg-4 col-sm-4">
        <input type="text" name="sea_id" class="form-control" placeholder="nm season">
       </div>

    <div class="col-lg-4 col-sm-4">
      <div class=" mb-0 text-white">
        <button  type="submit" value="AutoData" name="Submit" class="btn btn-block btn--md btn-pink waves-effect waves-light">Import</button>
      </div> </div>  </div>
    </div>
    </div> <!-- end card-->
    </form>

@endsection
