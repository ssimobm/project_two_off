@extends('master.main')
@section('content')
<style media="screen">.card-body {padding: 6px 0;} </style>
<div class="container-fluid">
      <div class="owl-carousel owl-theme p-0">
        @foreach ($Movies as $k => $v)
           <x-generals.cardmovieslider :data="$v" />

        @endforeach
      </div>
</div>

         <div class="container-lg s-lg">

 <div class="home">

   <div class="dropdown float-right">
     <a href="{{url('/browse/tvshows')}}"  class="btn btn-outline-blue btn-sm">{{__('Load More')}}</a>
   </div>

          <h4 class="header-title mb-2"><i class="fas fa-tv noti-icon"></i> {{__('TvShows')}}</h4>
  <hr class="divider">
          <div class="row  justify-content-center">


  @foreach ($Tvshows as $k => $v)
         <x-generals.cardtvseason :data="$v" />
  @endforeach




         </div>
           </div>



 <div class="home">

          <div class="dropdown float-right">
            <a href="{{url('/browse/episodes')}}"  class="btn btn-outline-blue btn-sm">{{__('Load More')}}</a>
          </div>

          <h4 class="header-title mb-2"><i class="fas fa-play noti-icon"></i> {{__('Episodes')}}</h4>
   <hr class="divider">
          <div class="row  justify-content-center">


         @foreach ($Episodes as $k => $v)
         <x-generals.cardepisode :data="$v" />
         @endforeach




         </div>
      </div>


      <div class="home">

        <div class="dropdown float-right">
          <a href="{{url('/browse/movies')}}"  class="btn btn-outline-blue btn-sm">{{__('Load More')}}</a>
        </div>

     <h4 class="header-title mb-2"><i class="fas fa-film noti-icon"></i> {{__('Movies')}}</h4>
       <hr class="divider">
     <div class="row  justify-content-center">
       @foreach ($Movies as $k => $v)
       <x-generals.cardmovie :data="$v" />
             @endforeach
    </div>
     </div>
     </div>

     @endsection
