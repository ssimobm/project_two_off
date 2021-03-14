@extends('master.main')
@section('content')

<div class="container-md mx-md-auto">
    <div class="row justify-content-center px-0"  id="results">
@foreach ($data as $k => $v)
  @php
  $url = $v->where('id', $v->id)->first()->seasons ;

  $link = $url->tvshow_slug ;
  $id_ep = $url->id ;

  @endphp
<div class="col-lg-3 col-md-3 col-sm-4 col-6">

      <a href='{{ url('tvshows') }}/{{ $link }}/season/{{ $v->season_nm }}/episode/{{ $v->episode_nm }}' class="card filmoqbox filmoq-box getlink">
          {{-- <div class="bg-dark text-white">
  {{Str::limit($data->Name_tv, 20, '...')}}
  </div> --}}
  @if ($v->post_img)
    <img src="{{ url('storage/images') }}/{{$v->post_img}}" class="img-ep" alt="...">
  @elseif (isset($url->tvshow->tvdata->where('simokey', 'backdrop_img')->first()->simovalue))
    <img src="{{ url('storage/background/images') }}/{{$url->tvshow->tvdata->where('simokey', 'backdrop_img')->first()->simovalue}}" class="img-ep" alt="...">

  @else
    <div class="card-img-top">
    </div>
  @endif
  <div class="filmoq filmoq-blue filmoq-left">Season {{$v->season_nm}} </div>
  <div class="filmoq filmoq-blue filmoq-right">{{$v->episode_nm}} - <input type="checkbox" class="checkboxall" value="{{$v->id}}" > </div>
  <div class="card-body">
      <h5 class="card-title">
          {{-- Episode {{$data->Ep_Nm}} --}}
          {{Str::limit($v->name_tvshow, 35, '...')}}
      </h5>

  </div>
  </a>
  </div>

@endforeach
  </div>
  <div class="row justify-content-center px-0">
    <form class="col-3 mx-1" action="{{url("/admincp/autofixes/episodes")}}" method="post">
      @csrf
      <input type="text" class="array" name="array" value="" hidden>
      <div class="form-group mb-0 text-center">
      <div class="row justify-content-center px-0">
       <button class="btn btn-primary btn-block col-12" type="submit">fixe select</button>
      </div>
      </div>
      </form>
      <form class="col-3 mx-1" action="{{url("/admincp/autofixes/episodes")}}" method="post">
        @csrf
        <input type="text" class="array" name="array" value="" hidden>
        <input type="text" name="SelectAll" value="SelectAll" hidden>
        <div class="form-group mb-0 text-center">
        <div class="row justify-content-center px-0">
         <button class="btn btn-primary btn-block col-12" type="submit">fixe select All</button>
        </div>
        </div>
        </form>
        <div class="col-3 mx-1">
          <div class="row justify-content-center px-0">
            <button class="selectall btn btn-primary btn-block col-12">select All</button>
          </div>
        </div>
  </div>
<script type="text/javascript">
$(document).ready(function(){
iframesimo =  [] ;
$(".selectall").click(function(){
  $('.checkboxall').each(function() {
             $(this).attr('checked',!$(this).attr('checked'));
             ids = $(this).attr("value") ;
             if (this.checked && iframesimo[ids] != ids) {
               iframesimo.push(ids);
            }else {
              const keys = iframesimo.indexOf(ids);
              iframesimo.splice(keys, 1);
            }
              $('.array').attr("value",iframesimo) ;
         });

    });
});
$("input[type=checkbox]").click(function(e) {

//e.preventDefault();

const ids = $(this).attr("value") ;
if (this.checked && iframesimo[ids] !== ids) {
  iframesimo.push(ids);

}else {
  const keys = iframesimo.indexOf(ids);
  iframesimo.splice(keys, 1);
}
$('.array').attr("value",iframesimo) ;



   });
</script>
  </div>
@endsection
