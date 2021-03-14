@php
$nm_seasons =  $data ;
$nm_seasons = $data->season_nm;
$episodes_nm = ($data->episode()->orderBy('episode_nm', 'desc')->latest()->first()->episode_nm)??null;

@endphp
@if ($nm == 4 && isset($delet))
  <div class="col-lg-3 col-md-4 col-sm-4 col-6" id="{{$typename}}_{{ $delet }}" title="{{$data->title_old}}">


@else
  <div class="col-lg-2 col-md-3 col-sm-3 col-6" id="delet_{{ $data->id }}" title="{{$data->title_old}}">

@endif

<a href='{{ url('seasons') }}/{{ $data->slug }}' class="card filmoqbox filmoq-box getlink" >
{{-- <div class="bg-dark text-white">
{{Str::limit($data->Name_tv, 20, '...')}}
</div> --}}



<img src="{{ url('storage/images') }}/{{($data->post_img??$data->tvshow_img)??''}}
" class="img-tv-movies mx-auto d-block" alt="...">
<div class="filmoq filmoq-blue filmoq-left">Season {{$nm_seasons}} </div>
<div class="filmoq filmoq-blue filmoq-right">{{$episodes_nm}} </div>
<div class="card-body">
<h5 class="card-title">

{{-- Episode {{$data->Ep_Nm}} --}}
{{Str::limit($data->name, 16, '...')}}
</h5>

</div>
</a>
@if (isset($delet))
  <div class="ep_watch notify_tv_movie text-white">
    <button type="button" class="click_delet_select btn btn-blue" id="{{ $delet }}" typename="{{$typename}}" data-original-title="delet my movie">
  <i class="far fa-trash-alt"></i>
  </button>
  </div>
@else
  @canany(['Watch_later','Favorit','Notification'], "App\Models\User")
  <div class="ep_watch notify_tv_movie text-white">
  @canany(['Notification'], "App\Models\User")
  <button type="button" class="notify btn btn-danger" id="{{ $data->id }}" data-toggle="tooltip" types="tv" data-placement="top" titlee="{{$data->title_old}}" title="" data-original-title="Add Notification">
  <i class="fa fa-bell"></i>
  </button>
  @endcanany
  @canany(['Favorit'], "App\Models\User")
  <button type="button" class="favorit btn btn-danger" id="{{ $data->id }}" data-toggle="tooltip"  types="tv" data-placement="top" titlee="{{$data->title_old}}" title="" data-original-title="Add Favorit">
  <i class="far fa-heart"></i>
  </button>
  @endcanany
  @canany(['Watch_later'], "App\Models\User")
  <button type="button" class="watchlater btn btn-danger" id="{{ $data->id }}" data-toggle="tooltip"  types="tv" data-placement="top" titlee="{{$data->title_old}}" title="" data-original-title="Add watch later">
  <i class="fas fa-clock"></i>
  </button>
  @endcanany
  </div>
  @endcanany
@endif

</div>
