
@if (isset($data))
  @php
  $url = $data->where('id', $data->id)->first()->tv ;
  $link = $url->slug ;
  $id_ep = $url->id ;

  @endphp
@if ($nm == 4)
  <div class="col-md-4 col-sm-4 col-6"  id="{{$typename}}_{{ $delet }}">

@else
  <div class="col-lg-3 col-md-3 col-sm-4 col-6">
@endif

      <a href='{{ url('tvshows') }}/{{ $link }}/season/{{ $data->season_nm }}/episode/{{ $data->episode_nm }}' class="card filmoqbox filmoq-box getlink">
          {{-- <div class="bg-dark text-white">
  {{Str::limit($data->Name_tv, 20, '...')}}
  </div> --}}
  <img src="{{ url('storage/images') }}/{{$data->post_img}}" class="img-ep" alt="...">
  <div class="filmoq filmoq-blue filmoq-left">Season {{$data->season_nm}} </div>
  <div class="filmoq filmoq-blue filmoq-right">{{$data->episode_nm}} </div>
  <div class="card-body">
      <h5 class="card-title">
          {{-- Episode {{$data->Ep_Nm}} --}}
          {{Str::limit($data->name_tvshow, 20, '...')}}
      </h5>

  </div>
  </a>
  @if (isset($delet))
    <div class="notify_watch ep_watch text-white">
      <button type="button" class="click_delet_select btn btn-blue" id="{{ $delet }}" typename="{{$typename}}" data-original-title="delet my movie">
    <i class="far fa-trash-alt"></i>
    </button>
    </div>
  @else
  @canany(['Watch_later','Notification'], "App\User")
  <div class="notify_watch ep_watch text-white">
      @canany(['Notification'], "App\User")
      <button type="button" class="notify btn btn-danger" id="{{ $id_ep }}" types="tv" data-toggle="tooltip" data-placement="top" title="" titlee="{{$data->name}}" data-original-title="Add Notification">
          <i class="fa fa-bell"></i>
      </button>
      @endcanany
      @canany(['Watch_later'], "App\User")
      <button type="button" class="watchcon btn btn-danger" id="{{ $data->id }}" types="ep" data-toggle="tooltip" data-placement="top" title="" titlee="{{$data->name}}" data-original-title="Add watch later">
          <i class="fas fa-clock"></i>
      </button>
      @endcanany
  </div>
  @endcanany
  @endif
  </div>
@endif
<script type="text/javascript">



    $(".click_delet_select").on("click", function(){
    let type = $(this).attr('typename');
    let id = $(this).attr('id');
    let users = new UserData("#"+type+"_"+id) ;
    users.GetData("/users/notifications","POST",{type:type,id:id});
    users.get.delets_type();
  });



</script>
