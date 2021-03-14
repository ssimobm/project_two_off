@extends('master.main')
@section('content')

<div class="container-md mx-md-auto">
    <div class="row justify-content-center px-0"  id="results">
@foreach ($data->seasons??[] as $k => $v)
       {{-- <x-generals.cardtv :data="$v" /> --}}
       @php
       $nm_seasons =  $v ;
       $nm_seasons = $v->season_nm;
       $episodes_nm = $v->episode()->orderBy('episode_nm', 'desc')->latest()->first()->episode_nm;
       @endphp
       <div class="col-lg-2 col-md-3 col-sm-3 col-6" id="delet_{{ $v->id }}" title="{{$v->title_old}}">
       <a href='{{ url('seasons') }}/{{ $v->slug }}' class="card filmoqbox filmoq-box getlink" >
       <img src="{{ url('storage/images') }}/{{($v->post_img??$v->tvshow_img)??''}}
       " class="img-tv-movies mx-auto d-block" alt="...">
       <div class="filmoq filmoq-blue filmoq-left">Season {{$nm_seasons}} </div>
       <div class="filmoq filmoq-blue filmoq-right">{{$episodes_nm}} - <input class="checkboxall" type="checkbox" value="{{$v->id}}" > </div>
       <div class="card-body">
       <h5 class="card-title">
       {{-- Episode {{$data->Ep_Nm}} --}}
       {{Str::limit($v->name, 16, '...')}}
       </h5>

       </div>
       </a>
       </div>

@endforeach
  </div>
  <div class="row justify-content-center px-0">
    <form class="col-2 mx-2" action="{{url("/admincp/autofixes/season")}}" method="post">
      @csrf
      <input type="text" class="array" name="array" value="" hidden>
      <div class="form-group mb-0 text-center">
      <div class="row justify-content-center px-0">
       <button class="btn btn-primary btn-block col-12" type="submit">auto fixe</button>
      </div>
      </div>
      </form>
      <form class="col-2 mx-2" action="{{url("/admincp/autofixes/season/couper")}}" method="post">
        @csrf
        <input type="text"  name="id" value="{{$data->id??null}}" hidden>
        <div class="form-group mb-0 text-center">
        <div class="row justify-content-center px-0">
         <button class="btn btn-primary btn-block col-12" type="submit">tvshow new</button>
        </div>
        </div>
        </form>
        <form class="col-2 mx-2" action="{{url("/admincp/autofixes/tvshows")}}" method="post">
          @csrf
          <input type="text"  name="id" value="{{$data->id??null}}" hidden>
          <div class="form-group mb-0 text-center">
          <div class="row justify-content-center px-0">
           <button class="btn btn-primary btn-block col-12" type="submit">tvshow search</button>
          </div>
          </div>
          </form>
          <div class="col-2  mx-2">
            <div class="row justify-content-center px-0">
              <button class="selectall btn btn-primary btn-block col-12">select All</button>
            </div>
          </div>
  </div>
<script type="text/javascript">
$(document).ready(function(){
iframesimo =  [] ;
$(".selectall").click(function(){
  iframesimo =  [] ;
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
