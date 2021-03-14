@extends('master.main')

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
}
.img-ep {
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
  <!-- Owl Stylesheets -->
  <link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css">
<div class="container-fluid">
      <div class="owl-carousel owl-theme">
        @foreach ($Movies as $k => $v)
           <x-generals.cardmovieslider :data="$v" />

        @endforeach
      </div>
</div>
<script>
$(document).ready(function() {
  $('.owl-carousel').owlCarousel({
rtl:true,
loop:false,
margin:5,
nav:false,

responsiveClass:true,
autoplay:true,
autoplayTimeout:1500,
autoplayHoverPause:true,
responsive:{
  0:{
      items:2
  },
  480:{
      items:4
  },
  800:{
      items:5
  },
  1024:{
      items:6

  },

  1200:{
      items:7

  },
  1920:{
      items:9
  }
}
})
         })
       </script>
         <div class="container-lg s-lg">

 <div class="home">

          <div class="dropdown float-right">
    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
        <i class="mdi mdi-dots-vertical"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right" style="">
        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item">Action</a>
    </div>
          </div>

          <h4 class="header-title mb-2"><i class="fas fa-tv noti-icon"></i> TvShows</h4>
  <hr class="divider">
          <div class="row  justify-content-center">


  @foreach ($Tvshows as $k => $v)
         <x-generals.cardtv :data="$v" />
  @endforeach




         </div>
     <button type="button" class="btn btn-block btn-outline-blue btn-sm waves-effect waves-light  mb-4">Load More</button>
           </div>



 <div class="home">

          <div class="dropdown float-right">
    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
        <i class="mdi mdi-dots-vertical"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right" style="">
        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
        <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item">Action</a>
    </div>
          </div>

          <h4 class="header-title mb-2"><i class="fas fa-play noti-icon"></i> Episodes</h4>
   <hr class="divider">
          <div class="row  justify-content-center">


         @foreach ($Episodes as $k => $v)
         <x-generals.cardepisode :data="$v" />
         @endforeach




         </div>
<button type="button" class="btn btn-block btn-outline-blue btn-sm waves-effect waves-light  mb-4">Load More</button>
      </div>


      <div class="home">

     <div class="dropdown float-right">
         <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
   <i class="mdi mdi-dots-vertical"></i>
         </a>
         <div class="dropdown-menu dropdown-menu-right" style="">
   <!-- item-->
   <a href="javascript:void(0);" class="dropdown-item">Edit Report</a>
   <!-- item-->
   <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
   <!-- item-->
   <a href="javascript:void(0);" class="dropdown-item">Action</a>
         </div>
     </div>

     <h4 class="header-title mb-2"><i class="fas fa-film noti-icon"></i> Movies</h4>
       <hr class="divider">
     <div class="row  justify-content-center">
       @foreach ($Movies as $k => $v)
       <x-generals.cardmovie :data="$v" />
             @endforeach
    </div>
  <button type="button" class="btn btn-block btn-outline-blue btn-sm waves-effect waves-light  mb-4">
  Load More
  </button>
     </div>
     </div>

     @endsection
