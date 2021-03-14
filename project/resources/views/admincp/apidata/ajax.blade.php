@foreach ($data as $v)


  @if (isset($Tvshows->firstWhere('tmdb_id', $v->id)->tmdb_id))
    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
    <div class="card filmoqbox filmoq-box" >
      <img src="https://image.tmdb.org/t/p/w780{{$v->poster_path}}" class="img-tv-movies">
      <div class="filmoq-two-two filmoq-two-two-blue"> <span><i class="mdi mdi-access-point mr-1"></i> end</span> </div>
        <div class="card-body">

          <h5 class="card-title">
            {{Str::limit($v->name, 20, '...')}}
          </h5>

        </div>
      </div>
        </div>

  @else

    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
      <div class="card filmoqbox filmoq-box" >
        <img src="https://image.tmdb.org/t/p/w780{{$v->poster_path}}" class="img-tv-movies">
          <div class="card-body">
            <h5 class="card-title">  {{Str::limit($v->name, 20, '...')}}</h5>
            <div id='d{{$v->id}}'>
              <div id='{{$v->id}}'  class="tvshows_bt filmoq filmoq-blue filmoq-left"><i class="mdi mdi-access-point mr-1"></i> Import</div>
            </div>
          </div>
          </div>
        </div>

  @endif



        @endforeach
          <script  type="text/javascript">

          $('.tvshows_bt').click(function(){
          var tvshows =  $(this).attr("id");
          return FormsData('#tvshows_bt',"/admincp/data/tvshows/post/"+tvshows,"POST",{ids:tvshows,},"api_Iteam_import")
          });

          </script>
