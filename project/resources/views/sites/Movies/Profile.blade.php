@extends('master.main')

@section('title')
{{$Seo->title}}
@stop

@section('meta')
{{$Seo->meta}}
@stop

@section('content')
<div class="container-lg">
<div class="row  justify-content-center">
<div class="col-lg-2 col-md-3 col-12 p-0">
<div class="card">
<div class="row">
<div class="col-12">

<div class="d-md-block d-flex justify-content-md-start justify-content-center">
<div>
<div class="p-0 bd-highlight">
<div class="text-center">
<img class="img-info p-0 pb-1" src="{{ url('storage/images') }}/{{($tvdata->where('simokey', 'postimg')->first()->simovalue)??''}}" >
</div></div>
</div>
<div>
<div class="p-0 bd-highlight">@php
$rating = ($tvdata->where('simokey', 'rating')->first()->simovalue)??'5';
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
<div class="mx-2 py-1 bd-highlight card-title text-white">{{substr(($tvdata->where('simokey', 'first_date')->first()->simovalue)??'','0','4') }}</div>
</div>

@if (($tvdata->where('simokey', 'status')->first()->simovalue)??'' ==='Released')
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
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white">{{($tvdata->where('simokey', 'popular')->first()->simovalue)??'' }}</div>
</div>
<div class="d-flex justify-content-between bd-highlight">
<div class="mx-2 py-1 bd-highlight card-title text-white"><i class="fas fa-tv"></i> بالغ:</div>
@if (strlen(($tvdata->where('simokey', 'adult')->first()->simovalue)??'') > 1)
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white">بالغ</div>
@else
<div class="mx-2 py-1 bd-highlight card-title-info text-center text-white">غير بالغ</div>
@endif
</div>

<p class="card-text">
<small class="text-muted">{{($tvdata->where('simokey', 'first_date')->first()->simovalue)??''}}</small>
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
({{substr(($tvdata->where('simokey', 'first_date')->first()->simovalue)??'','0','4')}})</h3>
<div class="card-text bg-gray text-dark">


{!! $Tv->content !!}


<p class="card-text pt-2">
<small class="text-muted">Last updated {{ (new \Carbon\Carbon)->parse(($tvdata->where('simokey', 'first_date')->first()->simovalue)??'')->diffForHumans()  }}</small>
</p>
</div>

<div class="button-list py-2">
<button type="button" class="watchlater btn btn-icon btn-icon rounded-circle btn-blue mr-1  waves-effect waves-light" id="{{ $Tv->id }}" titlee="{{$Tv->title}}" data-toggle="tooltip" data-placement="top"  types="movie" title="" data-original-title="Add watch later"><i class="fas fas fa-clock"></i></button>
<button type="button" class="favorit btn btn-icon btn-icon rounded-circle btn-blue mr-1  waves-effect waves-light" id="{{ $Tv->id }}" titlee="{{$Tv->title}}" data-toggle="tooltip" data-placement="top" types="movie"  title="" data-original-title="Add Favorit"><i class="far fa-bookmark"></i></button>
</div>




<ul class="nav nav-tabs nav-bordered nav-justified">
<li class="nav-item">
<a href="#watched" data-toggle="tab" aria-expanded="true" class="nav-link active">
مشاهدة و تحميل
</a> </li>
</ul>

<div class="tab-content">
<div class="tab-pane active" id="watched">

<div class="row justify-content-center">
<a href='{{url()->current()}}/watch'  class="btn btn-lg btn-blue width-xl waves-effect waves-light" type="button" >
<span class="btn-label-left"><i class="fas fa-video"></i></span> مشاهدة و تحميل الفيلم
</a>
</div>

</div>


</div>





</div>
</div>
</div>
</div>
</div>

@endsection
