<div class="col-12">
<div class="app-content content">
  <div class="row">
  <div class="col-lg-9 col-sm-12 col-12">
 <style>
.resp-container {
    position:relative;
    overflow: hidden;
 padding-top: 56%;


}

.resp-iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
} dropdown .btn:not(.btn-sm):not(.btn-lg), .dropdown .btn:not(.btn-sm):not(.btn-lg).dropdown-toggle {
    WIDTH: 100%;
 }

 .col-lg-3.col-sm-12.col-12, .col-lg-9.col-sm-12.col-12 {
    PADDING: 1PX;
}.card-body {

    padding: 0px 3px;
}
.smtext-bn-simo {
    font-size: smaller;
    font-weight: 400;
    left: 50px;
    position: absolute;
    font-size: 14px;
}
.btn-group, .btn-group-vertical {

    width: 100%;
    DISPLAY: inline-block;
}
 .play-action {
float: left;
width: 100%;
padding: 10px;

DISPLAY: flex;
}
.action-bar-player {
display: inline-block;

}
.action-bar-player-left {
    float: left;
    position: absolute;
    left: 15PX;
}.action-bar-player-right {


float: right: ;;
    position: relative;
    right: 15PX;
}
i.feather.icon-chevrons-left {
    left: 20px;
    position: absolute;
}.col-lg-6.col-sm-12.col-12 {
    DISPLAY: contents;
}.play-action.row {
    margin-left: 0;
    margin-right: 0;
}.list-group-item.active, .btn-primary, .btn-blue {
    z-index: 2;
    color: #fff;
    background-color: #3b5f95!important;
    border-color: #3b5f95!important;
}.list-group-item-action {
  color: #ffffff!important;
    background-color: #323a46!important;
}.list-group-item-action:focus, .list-group-item-action:hover {
    z-index: 1;
    color: #ffffff!important;
    background-color: #3b5f95!important;
    border-color: #3b5f95!important;
}ul#myTab {
    padding: 1px 0px;
}.pt-1, .py-1 {
    padding-top: .1rem!important;
}.col-lg-3.col-sm-12.col-12 {
    background: #323a46;
}.col-lg-9.col-sm-12.col-12 {
    background: #323a46;
}div#simoid1 {
    padding: 3px 0 10px 0;
}
#resp-container {
    background:#323a46;
}


#loader1 {
    position:absolute;
    left:40%;
    top:35%;
    border-radius:20px;
    padding:25px;
    background:#ffffff;

} .content-page, .s-lg {
    max-width: 100%!important;
    padding: 0 0 0 0!important;

} </style><style>

.comment-area-box.simo  {
  display:none;
}i.fas.fa-reply.mr-1 {

    margin-left: 0!important;
}button.btn.btn-info.btn-sm, a.btn.btn-info.btn-sm {
  font-size: 10px;
padding: 2px;
BACKGROUND-COLOR: #4a81d4;
color: #ffffff;
border-color: #4a81d4;

}.post-user-comment-box {
    background-color: #3c4752;
    margin: 5px 0px 2px 0px!important;
    padding: 10px 5px 1px 5px!important;
    margin-top: 20px;
}p.text-muted {
    margin-bottom: 2px;
}p {

    word-break: break-all;
}.col-lg-12.col-sm-12.col-12 {
    padding-right: 0;
    padding-left: 0;
}

@media only screen and (max-width: 800px){
  .col-lg-12.col-sm-12.col-12 {
 padding-right: 0!important;
 padding-left: 0!important;
  }
  .col-lg-3.col-sm-12.col-12, .col-lg-9.col-sm-12.col-12 {
 PADDING: 10px 0 10px 0!important;
  }
}div#profile-b2 {

}  .simocoll {
  color: #f1556c;
}.box-edit-user {
    background: #252d35;
}
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
</style>
 <div class="card-content">
  <div class="card-body">

@php
  $data_base =$movies->server->where('type', 'movies');
  $data_link =$data_base->where('se_type', 'player')->first();
  $data_download =$data_base->where('se_type', 'download')->first();

@endphp
@if (isset($data_link->Links))
@php
  $data_uncodes = unserialize($data_link->Links)['player'];
@endphp
@foreach ($data_uncodes as $key => $value)
  @if ($key == 1)

    <div class="resp-container" id="resp-container">
<div id="loader1" class="d-flex justify-content-center">
<div class="spinner-border avatar-lg text-blue m-2" role="status"></div></div>
    <iframe class="resp-iframe" src="{{$value["link"]}}" gesture="media" allow="encrypted-media" allowfullscreen=""></iframe>

  </div>
    @endif
@endforeach
@else
<style>
.row.resp-container.justify-content-center {
  padding: 20%!important;
}
</style>
 <div class="row resp-container justify-content-center align-self-center">
  I'm vertically centered
 </div>

@endif



 <div class="play-action row">
<div class="col-lg-6 col-sm-12 col-12">
<ul class="action-bar-player-right nav">
<li class="nav-item">
    <button type="button" class="btn btn-icon btn-blue mr-1 mb-1 waves-effect waves-light"><i class="fas fa-arrow-right"></i></button>
</li>
 <li class="nav-item">
<button type="button" class="btn btn-icon btn-blue mr-1 mb-1 waves-effect waves-light"><i class="fas fa-arrow-left"></i></button>
 </li>

</ul>


     </div>
<div class="col-lg-6 col-sm-12 col-12">
<ul class="action-bar-player-left nav justify-content-end">
  <li class="nav-item">
  <button type="button" class="watchcon btn btn-icon btn-icon rounded-circle btn-blue mr-1 mb-1 waves-effect waves-light" id="{{ $movies->id }}" titlee="{{$movies->title}}" data-toggle="tooltip" data-placement="top"  title="" data-original-title="Add watch later"><i class="fas fa-calendar-alt"></i></button>
  </li>
  <li class="nav-item">
  <button type="button" class="favorit btn btn-icon btn-icon rounded-circle btn-blue mr-1 mb-1 waves-effect waves-light" id="{{ $movies->id }}" titlee="{{$movies->title}}" data-toggle="tooltip" data-placement="top"  title="" data-original-title="Add Favorit"><i class="far fa-bookmark"></i></button>
  </li>
    </ul>
    <div id="logindv"></div>
    </div>

    </div>
    </div>
     </div>
 </div>

   <div class="col-lg-3 col-sm-12 col-12">
   <div class="card-content">
  <div class="card-body">
   {{-- <div class="dropdown">
  <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-light " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Drop bottom right
    </button>
    <div class="dropdown-menu">

    </div>
     </div> --}}
 <!-- Nav tabs -->
<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
@if (isset($data_link->Links))
<li class="nav-item">
<a class="nav-link active" id="Players" data-toggle="tab" href="#Player" role="tab" aria-controls="Player" aria-selected="true">Player</a>
</li>
@endif
@if (isset($data_download->Links))
<li class="nav-item">
<a class="nav-link" id="profile-tab-fill" data-toggle="tab" href="#profile-fill" role="tab" aria-controls="profile-fill" aria-selected="false">Download</a>
</li>
@endif
<li class="nav-item">
<a class="nav-link" id="messages-tab-fill" data-toggle="tab" href="#messages-fill" role="tab" aria-controls="messages-fill" aria-selected="false">comments</a>
</li>

</ul>

 <!-- Tab panes -->
<div class="tab-content pt-1">

  @if (isset($data_link->Links))
    <div class="tab-pane active" id="Player" role="tabpanel" aria-labelledby="Players">
    <div class="list-group" id="list-tab" role="tablist">
  @php
    $data_uncodes = unserialize($data_link->Links)['player'];
  @endphp
  @foreach ($data_uncodes as $key => $value)
    @if ($key == 1)
 <button href="{{$value["link"]}}" target="resp-iframe" class="silink list-group-item list-group-item-action active"  data-toggle="list" >{{$value["name"]}} <small class="smtext-bn-simo">{{$value["quality"]}}</small></button>
 @else
  <button href="{{$value["link"]}}" target="resp-iframe" class="silink list-group-item list-group-item-action"  data-toggle="list" >{{$value["name"]}} <small class="smtext-bn-simo">{{$value["quality"]}}</small></button>
    @endif


  @endforeach
</div>

</div>
@endif

@if (isset($data_download->Links))
<div class="tab-pane" id="profile-fill" role="tabpanel" aria-labelledby="profile-tab-fill">

  @if (isset($data_download->Links))
  @php
    $data_uncodes1 = unserialize($data_download->Links)['download'];
  @endphp
  @foreach ($data_uncodes1 as $key => $value)

 <a class="list-group-item list-group-item-action" href="{{$value['link']}}" target="_blank" >{{$value["name"]}} <small class="smtext-bn-simo">{{$value["quality"]}}</small></a>

  @endforeach
  @endif


   </div>
   @endif
<div class="tab-pane" id="messages-fill" role="tabpanel" aria-labelledby="messages-tab-fill">


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

 iframesimo =  $(this).attr("href");
    $('.resp-container').html('<div id="loader1" class="d-flex justify-content-center"> <div class="spinner-border avatar-lg text-blue m-2" role="status"></div></div><iframe class="resp-iframe" src="'+ iframesimo +'" gesture="media" allow="encrypted-media" allowfullscreen="" ></iframe>');
     });
    $('.resp-iframe').on('load', function () {
 $('#loader1').hide();

    });
    });

    </script>
    <script src="{{asset('js/vendor.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
  </div>
