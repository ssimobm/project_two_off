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
<img class="img-info p-0 pb-1" src="{{ url('storage/images') }}/{{($tvdata->where('simokey', 'postimg')->first()->simovalue)??""}}" >
</div></div>
</div>
<div>
<div class="p-0 bd-highlight">@php
$rating = ($tvdata->where('simokey', 'rating')->first()->simovalue)??"1";
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
<div class="mx-2 py-1 bd-highlight card-title text-white">{{substr(($tvdata->where('simokey', 'first_date')->first()->simovalue)??"",'0','4') }}</div>
</div>

@if (($tvdata->where('simokey', 'status')->first()->simovalue)??"" ==='Released')
<div class="d-flex justify-content-between bd-highlight">
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white"><i class="fas fa-flag-checkered"></i> الحالة:</div>
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white">صدر</div>
</div>
@else
<div class="d-flex justify-content-between bd-highlight">
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white"><i class="far fa-calendar-alt"></i> السنة:</div>
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white">لم يصدر</div>
</div>
@endif
<hr class="divider"></hr>
<div class="d-flex justify-content-between bd-highlight">
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white"><i class="fas fa-fire"></i> الشعبية:</div>
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white">{{($tvdata->where('simokey', 'popular')->first()->simovalue)??""}}</div>
</div>
<div class="d-flex justify-content-between bd-highlight">

<div class="mx-2 py-1 bd-highlight card-title text-white"><i class="fas fa-flag-checkered"></i> الحالة:</div>
@if (($tvdata->where('simokey', 'status')->first()->simovalue)??"" ==='Returning Series')
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white">مستمر</div>
@else
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white">مكتمل</div>
@endif
</div>

<p class="card-text">
<small class="text-muted">{{($tvdata->where('simokey', 'first_date')->first()->simovalue)??""}}</small>
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
<h3 class="mt-2">{{$Tv->title}}
({{substr(($tvdata->where('simokey', 'first_date')->first()->simovalue)??"",'0','4')}})</h3>
<div class="card-text bg-gray text-dark">


{!! $Tv->content !!}



<p class="card-text pt-2">
<small class="text-muted">Last updated {{ (new \Carbon\Carbon)->parse(($tvdata->where('simokey', 'first_date')->first()->simovalue)??"")->diffForHumans()  }}</small>
</p>
</div>

<div class="button-list py-2">
<button type="button" class="watchlater btn btn-icon btn-icon rounded-circle btn-blue mr-1  waves-effect waves-light" id="{{ $Tv->id }}" titlee="{{$Tv->title}}" data-toggle="tooltip" data-placement="top"  types="tv" title="" data-original-title="Add watch later"><i class="fas fas fa-clock"></i></button>
<button type="button" class="favorit btn btn-icon btn-icon rounded-circle btn-blue mr-1  waves-effect waves-light" id="{{ $Tv->id }}" titlee="{{$Tv->title}}" data-toggle="tooltip" data-placement="top"  types="tv"  title="" data-original-title="Add Favorit"><i class="far fa-bookmark"></i></button>
<button type="button" class="notify btn btn-icon btn-icon rounded-circle btn-blue mr-1 waves-effect waves-light" id="{{ $Tv->id }}" titlee="{{$Tv->title}}" data-toggle="tooltip" data-placement="top"  types="tv"  title="" data-original-title="Add Notification"><i class="fa fa-bell"></i></button>
@canany(['AdmincpSuper','Admincp','Edit'], "App\Models\User")
<a type="button" class="btn btn-icon btn-icon rounded-circle  rounded-circle btn-light mr-1" href='{{ url('/admincp/tvshows/edit/') }}/{{$Tv->id}}' data-toggle="tooltip" data-placement="top"  data-original-title="edit"><i class="fas fa-edit"></i></a>
<a type="button" class="btn btn-icon btn-icon rounded-circle rounded-circle btn-light mr-1" href='{{ url('/admincp/autofixes/seasons') }}/{{$Tv->id}}' data-toggle="tooltip" data-placement="top"  data-original-title="autoFixe seasons"><i class="fa fa-magic"></i></a>
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
@foreach ($link as $key => $value)
@if (count($value['ep']) > 0)
@php $nmi = $nm++; @endphp
<a class="nav-link mb-1 @if ($nmi == 1) active  @endif" data-toggle="pill" href="#simoid-{{ $nmi }}" role="tab" aria-controls="simo_id{{ $nmi }}" aria-selected="@if ($nmi == 1) true  @endif">
{{ $value['name'] }}</a>
@endif
@endforeach
</div>
</div> <!-- end col-->

<div class="col-sm-9">
<div class="tab-content pt-0">
@php $nm = 1; @endphp
@foreach ($link as $key => $value)
@if (count($value['ep']) > 0)
@php $nmi = $nm++; @endphp
<div class="tab-pane fade @if ($nmi == 1) active show @endif list_all" id="simoid-{{ $nmi }}">

@foreach ($value['ep'] as $k => $v)
<a class="simoclist list-group-item" href="{{url("tvshows")}}/{{$Tv->slug}}/season/{{$value['season_nm']}}/episode/{{ $v->episode_nm }}">{{ $v->name_episode }}</a>
@endforeach

</div>


@endif
@endforeach
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
