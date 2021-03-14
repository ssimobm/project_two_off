@extends('master.main')

@section('content')
    <div class="container-xl mx-xl-auto ">
    <div class="row py-2 px-md-4 px-0">

<div class="col-lg-3 col-md-4 col-sm-12 col-12 ">
<h3 class='page-title text-center py-md-auto'>{{__('Watch Later')}}</h3>
<ul class="list-group d-none d-lg-block">
  <a href="{{url('/users/notifications')}}" class="list-group-item list-group-item-action"><i class="fas fa-bell mr-1"></i>{{__('Notification')}}</a>
  <a href="{{url('/users/favorit')}}" class="list-group-item list-group-item-action"><i class="fas fa-bookmark mr-1"></i>{{__('My Favorit')}}</a>
  <a href="{{url('/users/watchLater')}}" class="list-group-item list-group-item-action active_blue"><i class="fas fa-photo-video mr-1"></i>{{__('Watch Later')}}</a>
  <a href="{{url('/users/watchContinue')}}" class="list-group-item list-group-item-action"><i class="fas fa-tv mr-1"></i>{{__('Continue watching')}}</a>
</ul>
</div>
<div class="col-lg-9 col-md-12  col-sm-12 col-12">
  <div class="row justify-content-center px-md-4 px-0">
    <div class="col-lg-12 col-md-6 col-sm-12 col-12">
      <div class="text-lg-right  text-center mt-auto mt-lg-auto">
        <button type="button" typename='watch_later' class="click_deletall btn btn-danger  btn-sm  waves-effect waves-light"><i class="fas fa-trash-alt mr-1"></i>Clear All</button>
      </div>
   </div>
<div class="col-lg-auto col-md-12 col-sm-12 col-12">
{{-- ///////////////////////////////////// --}}
  <div class="row justify-content-center py-2" id="watch_later_id">
@foreach ($movies as $k => $v)
  @if ($v->type == "tvshows" )
  <x-generals.cardtv :data="$v->favorit_tvshows" nm='4' typename="watch_later" :delet="$v->id" />
  @endif
  @if ($v->type == "movies" )
  <x-generals.cardmovie :data="$v->favorit_movies" nm='4' typename="watch_later" :delet="$v->id"  />
  @endif
@endforeach
</div>
{{-- ///////////////////////////////////// --}}
</div>


</div>
</div>
</div>

</div>


@endsection
