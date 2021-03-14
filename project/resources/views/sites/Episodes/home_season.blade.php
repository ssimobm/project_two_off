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
    $data_base =$Episodes->server->where('type', 'episode');
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
<iframe class="videoiframe" src="{{$value->link}}" gesture="media"  referrerpolicy="{{($value->name == "Playtube") ? "no-referrer" : "" }}" allowfullscreen="">
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
<div class="play-action row">

<div class="col-12">
  <div class="d-flex justify-content-between">
    <div class="p-0">
    <ul class="action-bar-player-right nav">
      @if (isset($Seasons->episode->where('episode_nm', $Episodes->episode_nm - 1)->first()->episode_nm))
      <li class="nav-item">
      <a href="{{url('tvshows')}}/{{$Episodes->slug}}/season/{{$Seasons->season_nm}}/episode/{{$Episodes->episode_nm - 1}}" type="button" class="btn btn-icon btn-blue mr-1 mb-1 waves-effect waves-light" data-toggle="tooltip" data-placement="top"  title="" data-original-title="Previous Episode"><i class="fas fa-arrow-right"></i></a>
      </li>
      @endif

      @if (isset($Seasons->episode->where('episode_nm', $Episodes->episode_nm + 1)->first()->episode_nm))
      <li class="nav-item">
      <a href="{{url('tvshows')}}/{{$Episodes->slug}}/season/{{$Seasons->season_nm}}/episode/{{$Episodes->episode_nm + 1}}" type="button" class="btn btn-icon btn-blue mr-1 mb-1 aves-effect waves-light" data-toggle="tooltip" data-placement="top"  title="" data-original-title="Next Episode"><i class="fas fa-arrow-left"></i></a>
      </li>
      @endif
    </ul>
    </div>
    <div class="p-0">
      <div class="d-flex justify-content-end">
      <button type="button" class="watchcon btn btn-icon btn-icon rounded-circle btn-blue mr-1 waves-effect waves-light" id="{{ $Episodes->id }}" titlee="{{$Episodes->name}}" types="ep" data-toggle="tooltip" data-placement="top"  title="" data-original-title="Add watch later"><i class="fas fa-calendar-alt"></i></button>
      <button type="button" class="favorit btn btn-icon btn-icon rounded-circle btn-blue mr-1 waves-effect waves-light" id="{{ $Seasons->id }}" titlee="{{$Seasons->name}}" types="tv_season" data-toggle="tooltip" data-placement="top"  title="" data-original-title="Add Favorit"><i class="far fa-bookmark"></i></button>
      <button type="button" class="notify btn btn-icon btn-icon rounded-circle btn-blue mr-1 waves-effect waves-light" id="{{ $Seasons->id }}" titlee="{{$Seasons->name}}" types="tv_season" data-toggle="tooltip" data-placement="top"  title="" data-original-title="Add Notification"><i class="fa fa-bell"></i></button>

      @canany(['AdmincpSuper','Admincp','Edit'], "App\Models\User")
      <a type="button" class="btn btn-icon btn-icon rounded-circle  rounded-circle btn-light mr-1" href='{{ url('/admincp/episodes/edit/') }}/{{$Episodes->id}}' data-toggle="tooltip" data-placement="top"  data-original-title="edit"><i class="fas fa-edit"></i></a>
      <a type="button" class="btn btn-icon btn-icon rounded-circle rounded-circle btn-light mr-1" href='{{ url('/admincp/autofixes/seasons') }}/{{$Episodes->tv_id}}' data-toggle="tooltip" data-placement="top"  data-original-title="autoFixe seasons"><i class="fa fa-magic"></i></a>
      <a type="button" class="btn btn-icon btn-icon rounded-circle rounded-circle btn-light mr-1" href='{{ url('/admincp/autofixes/episodes') }}/{{$Episodes->sea_id}}' data-toggle="tooltip" data-placement="top"  data-original-title="autoFixe episodes"><i class="fa fa-magnet"></i></a>
      @endcanany

      </div>
    </div>

    </div>
</div>


</div>
</div>

<div class="col-lg-3 col-sm-12 col-12  px-0">
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
<li class="nav-item">
<a class="nav-link" id="episodes-tab-fill" data-toggle="tab" href="#episodes-fill" role="tab" aria-controls="episodes-fill" aria-selected="false">Episodes</a>
</li>
</ul>

 <!-- Tab panes -->
<div class="tab-content pt-1">
  @if ($data_link)
  <div class="tab-pane active" id="Player" role="tabpanel" aria-labelledby="Players">
  <div class="list-group list_all" id="list-tab" role="tablist">
  @foreach ($data_link as $key => $value)
  @if ($key == 0)
 <a getpost="{{$value->link}}" target="videoiframe" type="{{$value->name}}" class="silink simoclist list-group-item active"  data-toggle="list" >
   <div class="d-flex justify-content-between bd-highlight mx-auto">
       <div class="bd-highlight type">  {{$value->name}} </div>
       <div class="bd-highlight">{{$value->quality}}</div>
     </div>
 </a>
 @else
  <a getpost="{{$value->link}}" target="videoiframe" type="{{$value->name}}" class="silink  simoclist list-group-item"  data-toggle="list" >
    <div class="d-flex justify-content-between bd-highlight mx-auto">
        <div class="bd-highlight">  {{$value->name}} </div>
        <div class="bd-highlight">{{$value->quality}}</div>
      </div>
  </a>
  @endif
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
@foreach ($Seasons->episode->sortBy('episode_nm') as $key => $value)
@if (url()->current() == url('tvshows')."/".$Episodes->tvshow_slug."/season/".$Seasons->season_nm."/episode/".$value->episode_nm)
<a class="simoclist list-group-item active" href="{{url('tvshows')}}/{{$Episodes->slug}}/season/{{$Seasons->season_nm}}/episode/{{$value->episode_nm}}">{{$value->episode_nm}}</a>
@else
<a class="simoclist list-group-item" href="{{url('tvshows')}}/{{$Episodes->slug}}/season/{{$Seasons->season_nm}}/episode/{{$value->episode_nm}}">{{$value->episode_nm}}</a>
@endif
@endforeach
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

      <a href="{{url('tvshows')."/".$Seasons->tvshow_slug."/season/".$Seasons->season_nm}}">{{$Seasons->name}}</a>
      {{__('Episode')}} {{$Episodes->episode_nm}}
     <span class="spanReg"><span class="ribbon ribbon-primary"> ({{substr($Episodes->first_date,'0','4')}})</span></span>
    </h4>
     <div class="card-text">
      {!! $Episodes->overview !!}
    </div>
    <p class="card-text py-2">
       <small class="text-muted">Last updated {{ (new \Carbon\Carbon)->parse($Episodes->first_date)->diffForHumans()  }}</small>
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
    //  e.preventDefault();
  type =  $(this).attr("type");
  console.log(type);
  if (type == "Playtube") {
  type =  "no-referrer";
}else {
  type =  "unsafe-url";
}

  iframesimo =  $(this).attr("getpost");
     $('.videoembed').html('<div id="loader1" class="d-flex justify-content-center"> <div class="spinner-border avatar-lg text-blue m-2" role="status"></div></div><iframe class="videoiframe" src="'+ iframesimo +'" gesture="media" allow="encrypted-media" referrerpolicy="'+type+'" allowfullscreen="" ></iframe>');
      });
     $('.videoiframe').on('load', function () {
  $('#loader1').hide();

     });
     });

     </script>
@endsection
