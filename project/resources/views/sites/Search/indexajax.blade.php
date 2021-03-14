
<!-- item-->
<div class="dropdown-header noti-title">
<h5 class="text-overflow mb-2">Found {{count($Search)}} results</h5>
</div>
<!-- item-->

@foreach ($Search as $key => $value)
  @if ($value->type == 'movies')
    <a href="{{url("movies")}}/{{$value->slug}}" class="dropdown-item notify-item">
    <i class="fe-home mr-1"></i>
    <span>{{$value->title}}</span>
    </a>
    @else

      <a href="{{url("tvshows")}}/{{$value->slug}}" class="dropdown-item notify-item">
      <i class="fe-home mr-1"></i>
      <span>{{$value->title}}</span>
      </a>
  @endif

@endforeach
