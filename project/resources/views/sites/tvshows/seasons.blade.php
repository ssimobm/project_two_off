@extends('master.main')
@section('title')
{{$Seo->title}}
@stop

@section('meta')
{{$Seo->meta}}
@stop
@section('content')
<div class="container-fluid container-lg mx-auto">
<div class="row  justify-content-center">
<div class="col-lg-2 col-md-3 col-12 p-0">
<div class="card">
<div class="row">
<div class="col-12">

<div class="d-md-block d-flex justify-content-md-start justify-content-center">
<div>
<div class="p-0 bd-highlight">
<div class="text-center text-white">
<img class="img-info p-0 pb-1" src="{{ url('storage/images') }}/{{($tvshow->post_img??$tvshow->tvshow_img)??""}}" >
</div></div>
</div>
<div>
<div class="p-0 bd-highlight">@php
$rating = ($tvshow->rating)??"1";
$Crating = $rating;
$ratingid = ceil(($Crating)/2);

@endphp
@for ($i=5; $i > 0; $i--)

@if($ratingid >= $i)
<i class="fas fa-star checked mx-md-auto mx-0"></i>
@else
<i class="fas fa-star mx-md-auto mx-0"></i>
@endif

@endfor

<br>
<div class="d-flex justify-content-between bd-highlight">
<div class="mx-2 py-1 bd-highlight card-title text-white"><i class="far fa-calendar-alt"></i> التقييم:</div>
<div class="mx-2 py-1 bd-highlight card-title text-white"><i class="fe-star-on checked"></i> {{$rating}}</div>
</div>


<div class="d-flex justify-content-between bd-highlight">
<div class="mx-2 py-1 bd-highlight card-title text-white"><i class="far fa-calendar-alt"></i> السنة:</div>
<div class="mx-2 py-1 bd-highlight card-title text-white">{{substr(($tvshow->first_date)??"",'0','4') }}</div>
</div>

<hr class="divider"></hr>
<div class="d-flex justify-content-between bd-highlight">
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white"><i class="fas fa-fire"></i> الشعبية:</div>
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white">{{($tvshow->popular)??""}}</div>
</div>
<div class="d-flex justify-content-between bd-highlight">

<div class="mx-2 py-1 bd-highlight card-title text-white"><i class="fas fa-flag-checkered"></i> الحالة:</div>
@if (($tvshow->tv_status)??"" ==='Returning Series')
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white">مستمر</div>
@else
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white">مكتمل</div>
@endif
</div>

<p class="card-text">
<small class="text-muted">{{($tvshow->first_date)??""}}</small>
</p>



</div>
</div>
</div>
</div>

</div>

</div>


</div>

<div class="col-lg-10 col-md-9 col-12">
<div class="grid-container">
<div class="card card-body">
<h3 class="mt-2">{{$tvshow->name}}
({{substr(($tvshow->first_date)??"",'0','4')}})</h3>
<div class="card-text bg-gray text-dark">


{!! $tvshow->overview !!}



<p class="card-text pt-2">
<small class="text-muted">Last updated {{ (new \Carbon\Carbon)->parse(($tvshow->first_date)??"")->diffForHumans()  }}</small>
</p>
</div>

<div class="button-list py-2">
<button type="button" class="watchlater btn btn-icon btn-icon rounded-circle btn-blue mr-1  waves-effect waves-light" id="{{ $tvshow->id }}" titlee="{{$tvshow->name}}" data-toggle="tooltip" data-placement="top"  types="tv_season" title="" data-original-title="Add watch later"><i class="fas fas fa-clock"></i></button>
<button type="button" class="favorit btn btn-icon btn-icon rounded-circle btn-blue mr-1  waves-effect waves-light" id="{{ $tvshow->id }}" titlee="{{$tvshow->name}}" data-toggle="tooltip" data-placement="top"  types="tv_season"  title="" data-original-title="Add Favorit"><i class="far fa-bookmark"></i></button>
<button type="button" class="notify btn btn-icon btn-icon rounded-circle btn-blue mr-1 waves-effect waves-light" id="{{ $tvshow->id }}" titlee="{{$tvshow->name}}" data-toggle="tooltip" data-placement="top"  types="tv_season"  title="" data-original-title="Add Notification"><i class="fa fa-bell"></i></button>
@canany(['AdmincpSuper','Admincp','Edit'], "App\Models\User")
<a type="button" class="btn btn-icon btn-icon rounded-circle  rounded-circle btn-light mr-1" href='{{ url('/admincp/seasons/edit/') }}/{{$tvshow->id}}' data-toggle="tooltip" data-placement="top"  data-original-title="edit"><i class="fas fa-edit"></i></a>
<a type="button" class="btn btn-icon btn-icon rounded-circle rounded-circle btn-light mr-1" href='{{ url('/admincp/autofixes/seasons') }}/{{$tvshow->tv_id}}' data-toggle="tooltip" data-placement="top"  data-original-title="autoFixe seasons"><i class="fa fa-magic"></i></a>
<a type="button" class="btn btn-icon btn-icon rounded-circle rounded-circle btn-light mr-1" href='{{ url('/admincp/autofixes/episodes') }}/{{$tvshow->id}}' data-toggle="tooltip" data-placement="top"  data-original-title="autoFixe episodes"><i class="fa fa-magnet"></i></a>
@endcanany
</div>



<div class="card">


<ul class="nav nav-tabs nav-bordered nav-justified">
@if (count($link) > "0")
<li class="nav-item">
<a href="#seo_ep" data-toggle="tab" aria-expanded="true" class="nav-link active">
جميع المواسم و الحلقات
</a> </li>
@endif
</ul>
@if (count($link) > "0")
<div class="tab-content">
<div class="tab-pane active" id="seo_ep">
<div class="row  mx-auto">
<div class="col-sm-3">
@php $nm = 1; @endphp
<div class="nav flex-column nav-pills nav-pills-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
<a class="nav-link mb-1 active" data-toggle="pill" href="#simoid-1" role="tab" aria-controls="simo_id1" aria-selected="true">
{{ $tvshow->name_season }}</a>
</div>
</div> <!-- end col-->

<div class="col-sm-9">
<div class="tab-content pt-0">
@php $nm = 1; @endphp

@php $nmi = $nm++; @endphp
<div class="tab-pane fade @if ($nmi == 1) active show @endif list_all" id="simoid-{{ $nmi }}">

@foreach ($link as $k => $v)
<a class="simoclist list-group-item" href="{{url("tvshows")}}/{{$tvshow->tvshow_slug}}/season/{{$tvshow->season_nm}}/episode/{{ $v->episode_nm }}">{{ $v->name_episode }}</a>
@endforeach

</div>

</div>
@endif
</div> <!-- end col-->
</div>
</div>
</div>



</div>
</div>
</div>
</div>
</div>
{{-- <div id="loginId"></div> --}}
<script type="text/javascript">

$(".simoclick").click(function(){
var myelement = $(this).attr("ido")
$('#'+myelement).slideToggle();
$(".toggle:visible").not('#'+myelement).hide();

});

</script>
@endsection
