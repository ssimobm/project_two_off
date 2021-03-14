@extends('master.main')
@section('title')
    {{$Seo->title}}
@stop

@section('meta')
    {{$Seo->meta}}
@stop
@section('content')
  @php
    $data_download = null ;
    $api = new \App\MyClass\SimoPhp ;
    $data_base =$movies->server->where('type', 'movies');
    $data_link = [];
    $data_download = [];
    foreach ($data_base as $key => $value) {
      if ($value->server_type == "player_encodes") {
      $value->link = $api->simodecrypt($value->link) ;
      $data_link[] = $value ;
    }
    if ($value->server_type == "player") {
    $data_link[] = $value ;
  }
      if ($value->server_type == "download_encodes") {
      $value->link = $api->simodecrypt($value->link) ;
      $data_download[] = $value ;
    }
    if ($value->server_type == "download") {
      $data_download[] = $value ;
    }

    }
    // dd($data_base);
    // $data_link =$data_base->where('server_type', 'player')->all();
    // $data_download =$data_base->where('server_type', 'download')->all();

  @endphp
  <style>
    body[data-sidebar-size=condensed] .left-side-menu {
       position: absolute;
       padding-top: 0;
       width: 0px!important;
       z-index: 5;
       display: none;
    }
  body[data-sidebar-size=condensed] .content-page {
        margin-right: 0px!important;
        margin-left: 0!important;
    }
  body[data-sidebar-size=condensed] .footer, .footer {position: relative!important;background-color: #3c4752!important; width: 100%; background-color: #f4f5f7;left: 0!important; right: 0!important;}

  .col-lg-6.col-sm-12.col-12 {
     DISPLAY: contents;
  }
  .content-page, .s-lg {
    max-width: 100%!important;
    padding: 0 0 0 0!important;

  }
    </style>
<div class="app-content content">
<div class="row">
<div class="col-lg-9 col-sm-12 col-12 px-0 pr-0">
@if ($data_link)
@foreach ($data_link as $key => $value)
@if ($key == 0)
<div class="videoembed" id="videoembed">
<div id="loader1" class="d-flex justify-content-center">
<div class="spinner-border avatar-lg text-blue m-2" role="status"></div></div>
<iframe class="videoiframe" src="{{$value->link}}" gesture="media" allow="encrypted-media" allowfullscreen="">
</iframe>
</div>
@endif
@endforeach
@else
<style>
.row.videoembed.justify-content-center {
  padding: 20%!important;
}
</style>
 <div class="row videoembed justify-content-center align-self-center">
  I'm vertically centered
 </div>
@endif
<div class="row p-0 mx-auto">
<div class="col-12">

<div class="d-flex justify-content-end py-1">
  <div class="d-flex">
  <button type="button" class="watchlater btn btn-icon btn-icon rounded-circle btn-blue mr-1 waves-effect waves-light" types="movie" id="{{ $movies->id }}" titlee="{{$movies->title}}" data-toggle="tooltip" data-placement="top"  title="" data-original-title="Add watch later"><i class="fas fa-clock"></i></button>
  <button type="button" class="favorit btn btn-icon btn-icon rounded-circle btn-blue mr-1 waves-effect waves-light"  types="movie" id="{{ $movies->id }}" titlee="{{$movies->title}}" data-toggle="tooltip" data-placement="top"  title="" data-original-title="Add Favorit"><i class="far fa-bookmark"></i></button>
  </div>
</div>

</div>


</div>
</div>

<div class="col-lg-3 col-sm-12 col-12   px-0">
<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
@if ($data_link)
<li class="nav-item">
<a class="nav-link active" id="Players" data-toggle="tab" href="#Player" role="tab" aria-controls="Player" aria-selected="true">Player</a>
</li>
@endif
@if ($data_download)
<li class="nav-item">
<a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill" role="tab" aria-controls="profile-fill" aria-selected="false">Download</a>
</li>
@endif
</ul>

 <!-- Tab panes -->
<div class="tab-content pt-1">
  @if ($data_link)
  <div class="tab-pane active" id="Player" role="tabpanel" aria-labelledby="Players">
  <div class="list-group list_all" id="list-tab" role="tablist">
  @foreach ($data_link as $key => $value)
  @if ($key == 0)
 <a getpost="{{$value->link}}" target="videoiframe" class="silink simoclist list-group-item active"  data-toggle="list" >
   <div class="d-flex justify-content-between bd-highlight mx-auto">
       <div class="bd-highlight">  {{$value->name}} </div>
       <div class="bd-highlight">{{$value->quality}}</div>
     </div>

</a>
 @else
   <a getpost="{{$value->link}}" target="videoiframe" class="silink simoclist list-group-item"  data-toggle="list" >
     <div class="d-flex justify-content-between bd-highlight mx-auto">
         <div class="bd-highlight">  {{$value->name}} </div>
         <div class="bd-highlight">{{$value->quality}}</div>
       </div>

  </a>  @endif
  @endforeach
</div>
</div>
@endif

@if ($data_download)
<div class="tab-pane list_all" id="profile-fill" role="tabpanel" aria-labelledby="profile-tab-fill">
  @if ($data_download)
  @foreach ($data_download as $key => $value)

 <a class="simoclist list-group-item" href="{{$value->link}}" target="_blank" >
   <div class="d-flex justify-content-between bd-highlight mx-auto">
       <div class="bd-highlight">  {{$value->name}} </div>
       <div class="bd-highlight">{{$value->quality}}</div>
     </div>
</a>
  @endforeach
  @endif
</div>
  @endif

<div class="tab-pane @if (!$data_link) active @endif" id="episodes-fill" role="tabpanel" aria-labelledby="episodes-tab-fill">
<div class="list-group list_all">

</div>
</div>

</div>
</div>

<div class="container-fluid  bg-dark">

    <div class="tab-profile container-lg">
    <div class="row  justify-content-center">
     <div class="col-md-12 col-12">
         <div class="grid-container">
    <div class="card card-body">
      <h4 class="card-title text-center">
     {{$movies->title}}
     <span class="spanReg"><span class="ribbon ribbon-primary"> ({{substr(($Data->where('simokey', 'first_date')->first()->simovalue)??'','0','4')}})</span></span>
    </h4>
     <div class="card-text">
      {!! $movies->content !!}
    </div>
    <p class="card-text py-2">
       <small class="text-muted">Last updated {{ (new \Carbon\Carbon)->parse(($Data->where('simokey', 'first_date')->first()->simovalue)??'')->diffForHumans()  }}</small>
     </p>
    </div>
    </div>
    </div>
</div>
</div>
</div>
    </div>
  </div>
  <script>

  $(document).ready(function(){
  $(".silink").click(function(e) {
      e.preventDefault();

  iframesimo =  $(this).attr("getpost");
     $('.videoembed').html('<div id="loader1" class="d-flex justify-content-center"> <div class="spinner-border avatar-lg text-blue m-2" role="status"></div></div><iframe class="videoiframe" src="'+ iframesimo +'" gesture="media" allow="encrypted-media" allowfullscreen="" ></iframe>');
      });
     $('.videoiframe').on('load', function () {
  $('#loader1').hide();

     });
     });

     </script>
@endsection
