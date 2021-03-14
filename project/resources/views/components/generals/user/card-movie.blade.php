
@if ($nm == 4)
  <div class="col-lg-3 col-md-4 col-sm-4 col-6 " id="{{$typename}}_{{ $delet }}" title="{{$data->title}}">

@else
  <div class="col-lg-2 col-md-3 col-sm-3 col-6 " id="title_{{ $data->id }}" title="{{$data->title}}">

@endif

    <a href='{{ url('movies') }}/{{ $data->slug }}' class="card filmoq-box getlink">
        {{-- <div class="bg-dark text-white">
{{Str::limit($data->Name_tv, 20, '...')}}
</div> --}}
<img src="{{ url('storage/images') }}/{{$data->tvdata->where('simokey', 'postimg')->first()->simovalue}}
" class="img-tv-movies mx-auto d-block" alt="...">
<div class="filmoq-two-two filmoq-two-two-blue"><span>Primary</span></div>

<div class="card-body">
    <h5 class="card-title">

        {{-- Episode {{$data->Ep_Nm}} --}}
        {{Str::limit($data->title, 16, '...')}}
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
@canany(['Watch_later','Favorit'], "App\User")
<div class="ep_watch notify_tv_movie text-white">
    @canany(['AdmincpSuper','Admincp','Favorit'], "App\User")
    <button type="button" class="favorit btn btn-danger" id="{{ $data->id }}" types="movie" data-toggle="tooltip" data-placement="top" titlee="{{$data->title}}" title="" titlee="{{$data->title}}" data-original-title="Add Favorit">
        <i class="far fa-heart"></i>
    </button>
    @endcanany
    @canany(['AdmincpSuper','Admincp','Watch_later'], "App\User")
    <button type="button" class="watchlater btn btn-danger" id="{{ $data->id }}" types="movie" data-toggle="tooltip" data-placement="top" title="" titlee="{{$data->title}}" data-original-title="Add watch later">
        <i class="fas fa-clock"></i>
    </button>
    @endcanany
</div>
@endcanany
@endif
</div>


<script type="text/javascript">



    $(".click_delet_select").on("click", function(){
    let type = $(this).attr('typename');
    let id = $(this).attr('id');
    let users = new UserData("#"+type+"_"+id) ;
    users.GetData("/users/notifications","POST",{type:type,id:id});
    users.get.delets_type();
  });



</script>
