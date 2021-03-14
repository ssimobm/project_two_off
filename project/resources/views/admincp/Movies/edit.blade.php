@extends('master.add-post')

  @section('Post_id')

    <div class="col-12"> <div class="page-title-box"> <div class="page-title-right">
      <ol class="breadcrumb m-0"><li class="breadcrumb-item">
      Filmoq</li> <li class="breadcrumb-item"><a href="javascript: void(0);">Season</a></li>
       <li class="breadcrumb-item active"><a href="javascript: void(0);">Add Season</a></li>
     </ol> </div>
      <h4 class="page-title" >ADD Season</h4> </div> </div>

      <form class="parsley-examples needs-validation was-validated" action="{{ url('/admincp/movies/edit') }}/{{$movies->id}}" enctype="multipart/form-data" method="post">

    <div class="row">
    @csrf
    <div class="col-lg-8 col-sm-12">

      <div class="py-1 mb-0">
     <input type="text" id="simpleinput" name="addTiltle" class="form-control" placeholder="ADD Title" value="{{$movies->title}}">
    </div>
    <div class="py-0 mb-0">
    <textarea name="editor">
      {{$movies->content}}
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
         <input type="text" name="Title_tv_org" class="form-control" placeholder="Title_tv_org" value="{{$movies->title_org}}">
       </div>
       <div class="col-6  py-1 mb-0">
         <input type="text" name="Status" class="form-control" placeholder="Status" value="{{$Data->where('simokey', 'status')->first()->simovalue}}">
       </div>


       <div class="col-6 py-1 mb-0">
         <input type="text" name="id_tmdb" class="form-control" placeholder="idData" value="{{$movies->tmdb_id }}">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="text" name="id_imdb" class="form-control" placeholder="idImdb" value="{{$movies->imdb_id }}">
       </div>
      <div class="col-6 py-1 mb-0">
         <input type="text" name="Country" class="form-control" placeholder="country" value="{{$Data->where('simokey', 'country')->first()->simovalue}}">
       </div>
       <div class="col-md-3 col-6 py-1 mb-0">
         <input type="text" name="Language" class="form-control" placeholder="lang" value="{{$Data->where('simokey', 'language')->first()->simovalue}}">
       </div>
       <div class="col-md-3 col-6 py-1 mb-0">
         <input type="text" name="LanguageOrg" class="form-control" placeholder="language org"  value="{{$Data->where('simokey', 'language_org')->first()->simovalue}}">
       </div>

       <div class="col-6 py-1 mb-0">
         <input type="text" name="Video" class="form-control" placeholder="Video" value="{{$Data->where('simokey', 'trailer')->first()->simovalue}}">
       </div>
       <div class="col-6 py-1 mb-0">
         <input type="text" name="adult" class="form-control" placeholder="adult" value="{{$Data->where('simokey', 'adult')->first()->simovalue}}">
       </div>
       <div class="col-lg-6 col-md-6 col-6  py-1 mb-0">
         <div class="form-group row">
           <label for="example-input-normal" class="col-4 col-form-label d-none d-md-block"
       >first_date</label>
       <div class="col-md-8 col-12">
       <input type="date" name="FirstDate" class="form-control" placeholder="first date" value="{{$Data->where('simokey', 'first_date')->first()->simovalue}}">
       </div></div></div>
       <div class="col-md-6 col-6 py-1 mb-0">
                <input type="text" name="Timeep" class="form-control" placeholder="Timeep" value="{{$Data->where('simokey', 'run_time')->first()->simovalue}}">
              </div>
       <div class="col-md-4 col-6 py-1 mb-0">
         <input type="text" name="Popular" class="form-control" placeholder="Popular" value="{{$Data->where('simokey', 'popular')->first()->simovalue}}">
       </div>
       <div class="col-md-4 col-6 py-1 mb-0">
         <input type="text" name="Rating" class="form-control" placeholder="Rating" value="{{$Data->where('simokey', 'rating')->first()->simovalue}}">
       </div>
       <div class="col-md-4 col-6 py-1 mb-0">
       <input type="text" name="VoteCount" class="form-control" placeholder="vote_count" value="{{$Data->where('simokey', 'vote_count')->first()->simovalue}}">
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
                <x-admin.servers :data="$movies->server" type="movies" typeserver="player" />




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
                  <x-admin.servers :data="$movies->server" type="movies" typeserver="download" />



                  </div>
                  </div> <!-- end card-->







            <!-- end data-->
           </div>


     </div>
     </div> <!-- end card-->
     <form action="{{ url('/admincp/movies/edit') }}/{{$movies->id}}" method="post">
           @csrf
           <div class="col-12 card py-2">
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
         </form>
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
        @if ($movies->Tags)
        @foreach ($movies->Tags->where('taxonomy', 'Tags')->all() as $key => $value)
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



@foreach ($Categorys->where('taxonomy', 'Categorys')->all() as $key => $value)
  @if (isset($movies->Tags->where('taxonomy', 'Categorys')->first()->Tags->name))

  @if ($movies->Tags->where('taxonomy', 'Categorys')->first()->Tags->name == $value->name)


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
<a data-toggle="collapse" href="#Category" role="button" aria-expanded="false" aria-controls="Category"><i class="mdi mdi-minus"></i></a>

</div>
<h5 class="card-title mb-0 text-white">ADD Quality</h5>
</div>
<div id="Category" class="collapse show">
<select class="custom-select " name="quality">
  @foreach ($Categorys->where('taxonomy', 'Quality')->all() as $key => $value)
    @if (isset($movies->Tags->where('taxonomy', 'Quality')->first()->Tags->name))

    @if ($movies->Tags->where('taxonomy', 'Quality')->first()->Tags->name == $value->name)


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
    <input type="file" name="addPhoto" data-plugins="dropify" data-max-file-size="1M" data-allowed-file-extensions="jpg png svg" data-default-file="{{ url('storage/images') }}{{ $Data->where('simokey', 'postimg')->first()->simovalue??null	 }}" />

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

    <script type="text/javascript">
          simo = '{{isset($data_uncodes) ? count($data_uncodes)+1 :"1"}}';
          $("#addRow").click(function () {
            simo++ ;
              var html = '';
              html += '<div id="inputFormRow">';
              html += '<div class="input-group mb-3">';
              html += '<input type="text" name="se_data[player]['+ simo +'][name]" id="validationCustom02" class="col-2 form-control m-input" placeholder="Enter title" autocomplete="off"  required="" data-parsley-minlength="3">';
              html += '<input type="text" name="se_data[player]['+ simo +'][link]" id="validationCustom02" class="col-8 form-control m-input" placeholder="Enter title" autocomplete="off"  required="" data-parsley-minlength="3">';
               html += '<input type="text" name="se_data[player]['+ simo +'][quality]" id="validationCustom02" class="col-2 form-control m-input" placeholder="quality" autocomplete="off" required="" data-parsley-minlength="3">';

              html += '<button id="removeRow" type="button" class="col-2 btn btn-danger">Remove</button>';

              html += '</div>';

              $('#newRow').append(html);
          });

          // remove row
          $(document).on('click', '#removeRow', function () {
              $(this).closest('#inputFormRow').remove();
          });
</script>
<script type="text/javascript">

          simoo = '{{isset($data_uncodes_down) ? count($data_uncodes_down)+1 :"1"}}';
          $("#addRowdown").click(function () {
            simoo++ ;
              var html = '';
              html += '<div id="inputFormRowdown">';
              html += '<div class="input-group mb-3">';
              html += '<input type="text" name="se_down[download]['+ simoo +'][name]" id="validationCustom02" class="col-2 form-control m-input" placeholder="Enter title" autocomplete="off"  required="" data-parsley-minlength="3">';
              html += '<input type="text" name="se_down[download]['+ simoo +'][link]" id="validationCustom02" class="col-8 form-control m-input" placeholder="Enter title" autocomplete="off"  required="" data-parsley-minlength="3">';
               html += '<input type="text" name="se_down[download]['+ simoo +'][quality]" id="validationCustom02" class="col-2 form-control m-input" placeholder="quality" autocomplete="off" required="" data-parsley-minlength="3">';

              html += '<button id="removeRowdown" type="button" class="col-2 btn btn-danger">Remove</button>';

              html += '</div>';

              $('#newRowdown').append(html);
          });

          // remove row
          $(document).on('click', '#removeRowdown', function () {
              $(this).closest('#inputFormRowdown').remove();
          });

      </script>
@endsection
