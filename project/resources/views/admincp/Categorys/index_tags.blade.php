@extends('master.main')

@php

@endphp
@section('content')

  <style>
  .filmoq-right {
      float: right!important;
  }
  .filmoqbox .filmoq.filmoq-right {
      border-radius: 0 3px 3px 0;
      left: -8px;
  }
  .filmoqbox .filmoq.filmoq-left {
    border-radius: 0 3px 3px 0;
    right: -8px;
  }
  .filmoqbox .filmoq {
      position: absolute;
      clear: both;
      padding: 5px 12px;
      margin-bottom: 15px;
      box-shadow: 2px 5px 10px rgba(50,58,70,.15);
      color: #fff;
      font-size: 13px;
      font-weight: 600;
      top: 10px;

  }

  .filmoqbox .filmoq-blue {
   background-color: #0058a3;
  }
  .filmoqbox .filmoq-blue:before {
   border-color: #0058a3 transparent transparent;
  }
  .filmoqbox .filmoq-left:before {
      right: 0;
      left: auto;
  }
  .filmoqbox .filmoq:before {
  content: " ";
    border-style: solid;
    border-width: 10px;
    display: block;
    position: absolute;
    bottom: -10px;
    left: 0;
    margin-bottom: -10px;
    z-index: -1;
  }





  .img-tv-movies {
        padding: 0!important;
    background-color: #ffffff;
    border: 0;
    border-radius: 0;
    height: 220px;
    width: 100%;
  }.img-ep {
    padding: 0!important;
    background-color: #ffffff;
    border: 0;
    border-radius: 0;
    height: 120px;
    width: 100%;
  }


  .card-body {
      flex: 1 1 auto;
      min-height: 1px;
      padding: 6px 0;
  }.card-title {
      margin-bottom: 5px;
  }.card {
    PADDING: 0!important;
  }
  .bg-dark {
    padding: 10px 0px;

  }.btn1 {
    display: block;
    padding: 4px 15px!important;
  }
  .justify-content-center {
  justify-content: center!important;
  text-align: center;
  }

  .filmoq-danger {
  background: #0058a3!important;
  }
  .filmoq-blue:hover, .filmoq-blue:focus {
  color: #0058a3;
  background: #ffffff!important;
  border-color: #0058a3;
  }

  .owl-theme .owl-nav.disabled+.owl-dots {
    margin-top: 10px;
    width: 0;
    padding: 0;
    height: 0;
  }.owl-theme .owl-dots .owl-dot{display: none!important;}


  .card-title {
    margin-bottom: 5px;
    text-align: center;
  }.container-fluid, .container-lg, .container-md, .container-sm, .container-xl {

    padding-right: 0!important;
    padding-left: 0!important;

  }

  .filmoq-box .filmoq-two-two span {
    font-size: 13px;
    color: #fff;
    text-align: center;
    line-height: 20px;
    transform: rotate(-45deg)!important;
    width: 100px;
    display: block;
    box-shadow: 0 0 8px 0 rgba(0,0,0,.06), 0 1px 0 0 rgba(0,0,0,.02);
    position: absolute;
    top: 19px!important;
    left: -21px!important;
    font-weight: 600;
  }.filmoq-box .filmoq-two-two {
    position: absolute;
    left: 0px!important;
    right: auto!important;
    top: -5px!important;
    z-index: 1;
    overflow: hidden;
    width: 75px;
    height: 75px;
    text-align: right;
  }.filmoq-box .filmoq-two-two span {

    right: 0;

  }.filmoq-box .filmoq-two-two-blue span:before {
    border-left: 3px solid #0058a3;
    border-top: 3px solid #0058a3;
  }.filmoq-box .filmoq-two-two-blue span {
  background-color: #c70000;
  }
  .filmoq-box .filmoq-two-two span:before {
    content: "";
    position: absolute;
    left: 0;
    top: 100%;
    z-index: -1;
    border-right: 3px solid transparent;
    border-bottom: 3px solid transparent;
  }.filmoq-box .filmoq-two-two-blue span:after {
    border-right: 3px solid #0058a3;
    border-top: 3px solid #0058a3;
  }.filmoq-box .filmoq-two-two span:after {
    content: "";
    position: absolute;
    right: 0;
    top: 100%;
    z-index: -1;
    border-left: 3px solid transparent;
    border-bottom: 3px solid transparent;
  }
  .home {

    padding: 0;
    box-shadow: 0 0.75rem 6rem rgba(56,65,74,.03);
    margin-bottom: 0px;
    border-radius: .25rem;
    /* width: 100%; */
  }.row.justify-content-center {
    padding: 4px 0;
  }

  @media screen and (min-width: 800px) {
  .col-lg-2 {
      flex: 5 1 100%;
      max-width: 20%;
  }
  }
  </style>
<div class="container">
<div class="row">

@foreach ($Categorys as $k => $v)

  @if (isset($v->id))
    <div class="col-lg-2 col-md-3 col-sm-3 col-6" id="#title_{{ $v->id }}" title="{{$v->title}}">
     @if (isset(Auth::user()->id))
      <div class="bg-dark text-white">
        <button type="button" class="notify btn btn-danger" id="{{ $v->id }}" data-toggle="tooltip" data-placement="top" titlee="{{$v->title}}" title="" data-original-title="Add Notification">
        <i class="fa fa-bell"></i>
          </button>
        <button type="button" class="favorit btn btn-danger" id="{{ $v->id }}" data-toggle="tooltip" data-placement="top" titlee="{{$v->title}}" title="" data-original-title="Add Favorit">
        <i class="far fa-heart"></i>
          </button>
         <button type="button" class="watchlater btn btn-danger" id="{{ $v->id }}" data-toggle="tooltip" data-placement="top" titlee="{{$v->title}}" title="" data-original-title="Add watch later">
        <i class="fas fa-clock"></i>
         </button>
       </div>
       @endif

      <a href='{{ url('/admincp/tvshows') }}/{{ $v->slug }}' class="card filmoqbox filmoq-box getlink" >
        {{-- <div class="bg-dark text-white">
        {{Str::limit($v->Name_tv, 20, '...')}}
        </div> --}}
        <img src="{{ url('storage/images') }}/{{$v->tvdata->where('simokey', 'tvshow_Postimg')->first()->simovalue}}
          " class="img-tv-movies mx-auto d-block" alt="...">
          <div class="filmoq filmoq-blue filmoq-left">Season {{$v->tvdata->where('simokey', 'tvshow_NmSe')->first()->simovalue}} </div>
          <div class="filmoq filmoq-blue filmoq-right">{{$v->tvdata->where('simokey', 'tvshow_NmSe')->first()->simovalue}} </div>

          <div class="card-body">
  <h5 class="card-title">

  {{-- Episode {{$v->Ep_Nm}} --}}
  {{Str::limit($v->title, 16, '...')}}
  </h5>

          </div>



        </a>
          </div>
  @endif

@endforeach



  </div>


</div>

<script type="text/javascript">
function simo(name,id,link,dato,title) {
$(document).ready(function(){
  $.ajaxSetup({
    headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
  url: link,
  method:"POST",
  dataType: 'html',
  data:{id:id,type:name},
  success: function(data, status){if (status == "success")
  {
    toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-left",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
if (data == 'success') {
  toastr["success"]("تم حذف "+title+" ","نجاح");
}else {
   toastr["error"]("تم حذف "+title+" ","نجاح");
 }
 }}
  });
});
};

function view(data,id) {
  if (data === "delet") {
  //  $("#"+id).remove() ;
  }

}
$(".favorit").click( function(){

var id = $(this).attr("id");
var title = $(this).attr("titlee");
simoo =  simo("favorit",id,"{{ url('/admincp/Profile/Favorit/Add') }}",view('favorit',id),title);
$("#SimoO").html(simoo);

 });
 $(".watchcon").click( function(){

 var id2 = $(this).attr("id");
 var title2 = $(this).attr("titlee");
 simoo2 =  simo("watchcon",id2,"{{ url('/admincp/Profile/watchcon/Add') }}",view('watchcon',id2),title2);
 $("#SimoO3").html(simoo2);
         });

$(".watchlater").click( function(){

var id1 = $(this).attr("id");
var title1 = $(this).attr("titlee");
simoo1 =  simo("Watchlater",id1,"{{ url('/admincp/Profile/Watchlater/Add') }}",view('Watchlater',id1),title1);
$("#SimoO2").html(simoo1);

          });

$(".notify").click( function(){

var id2 = $(this).attr("id");
var title2 = $(this).attr("titlee");
simoo2 =  simo("notify",id2,"{{ url('/admincp/Profile/Notify/Add') }}",view('notify',id2),title2);
$("#SimoO3").html(simoo2);
        });

</script>

@endsection
