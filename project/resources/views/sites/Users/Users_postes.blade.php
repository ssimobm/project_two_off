@extends('master.main')

@section('content')

  <div class="container-xl mx-xl-auto ">
  <div class="row py-2 px-lg-3 px-1">

<div class="col-lg-3 col-md-4 col-sm-12 col-12">
<h3 class='page-title text-center py-md-auto'>({{count($simo->where('liks_type', 'Notify')->where('liks', '1'))}}) {{__('Notification')}}</h3>
<ul class="list-group d-none d-lg-block">
  <a href="{{url('users/notifications')}}" class="list-group-item list-group-item-action active_blue"><i class="fas fa-bell mr-1"></i>{{__('Notification')}}</a>
  <a href="{{url('users/favorit')}}" class="list-group-item list-group-item-action"><i class="fas fa-bookmark mr-1"></i>{{__('My Favorit')}}</a>
  <a href="{{url('users/watchLater')}}" class="list-group-item list-group-item-action"><i class="fas fa-photo-video mr-1"></i>{{__('Watch Later')}}</a>
  <a href="{{url('users/watchContinue')}}" class="list-group-item list-group-item-action"><i class="fas fa-tv mr-1"></i>{{__('Continue watching')}}</a>
</ul>
</div>
<div class="col-lg-9 col-md-8 col-sm-12 col-12">
  <div class="row px-md-5 px-0">
    <div class="col-lg-12 col-md-6 col-sm-12 col-12 py-1">
      <div class="text-lg-right  text-center mt-auto mt-lg-auto">
      <button type="button" typename='notify' class="click_deletall btn btn-danger btn-sm  waves-effect waves-light"><i class="fas fa-trash-alt mr-1"></i>Clear All</button>
      </div>
   </div>
<div class="col-lg-12 col-md-12 col-sm-12 col-12 py-1">
<div class="table">
  <table class="table table-dark text-white mb-0" id="notify_id">

@foreach ($simo->where('liks_type', 'Notify') as $k => $v)
  @php

$ids = $v->tvshowsdata ;
$names = $ids->title;
$linkes = $ids->tvdata ;

if (isset($linkes->where('simokey', 'postimg')->first()->simovalue)) {
  $images = $linkes->where('simokey', 'postimg')->first()->simovalue;
}else {
$images = $linkes->where('simokey', 'postimg')->first()->simovalue;
}
  @endphp


<tr id="notify_{{$v->id}}" class='@if ($v->liks == '1') menuitem-active  @endif'>
<td class="py-1" ><a href='{{url('/tvshows/'.$ids->slug)}}' id='{{$v->id}}' class="click_notif active_blue">
<div class="media"> <img class="d-flex align-self-center mr-3" src="{{url('storage/images')}}/{{$images}}" alt="Generic placeholder image" height="65">
<div class="media-body">
<p class="page-title mt-1 mb-0 font-16">{{$names}}</p>
<p class="mt-1 mb-0 "><b>{{ $v->created_at->diffForHumans()  }}</p>
</div>
</div></a>
</td>
@if ($v->liks == '1')
<td class="py-1"> <div class="text-center mt-2 mb-0 font-16">
 <div class="badge font-14 bg-soft-success text-success px-1">New</div>
 </div></td>
 @else
   <td class="py-1" > <div class="text-center mt-2 mb-0 font-16">
    <div class="badge font-14 bg-soft-success text-orange px-1">Old</div>
    </div></td>
@endif
<td class="py-1"> <div class="text-sm-right mt-2 mb-0 font-16">
 <a id='{{$v->id}}' typename='notify' class="click_delet_select btn btn-danger action-icon"> <i class="mdi mdi-delete"></i></a>
 </div></td>


</tr>
@endforeach


</table>
</div>

</div>


</div>
</div>
</div>

</div>


@endsection
