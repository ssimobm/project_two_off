@foreach ($data as $v)
  @if (isset($Movies->firstWhere('tmdb_id', $v->id)->tmdb_id))
    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
    <div class="card filmoqbox filmoq-box" >
      <img src="https://image.tmdb.org/t/p/w780{{$v->poster_path}}" class="img-tv-movies">
      <div class="filmoq-two-two filmoq-two-two-blue"> <span><i class="mdi mdi-access-point mr-1"></i> end</span> </div>
        <div class="card-body">

          <h5 class="card-title">
            {{Str::limit($v->title, 20, '...')}}
          </h5>

        </div>
      </div>
        </div>

  @else

    <div class="col-lg-2 col-md-3 col-sm-4 col-6">
      <div class="card filmoqbox filmoq-box" >
        <img src="https://image.tmdb.org/t/p/w780{{$v->poster_path}}" class="img-tv-movies">
          <div class="card-body">
            <h5 class="card-title">  {{Str::limit($v->title, 20, '...')}}</h5>
            <div id='d{{$v->id}}'>
              <div id='{{$v->id}}'  class="movies_bt filmoq filmoq-blue filmoq-left"><i class="mdi mdi-access-point mr-1"></i> Import</div>
            </div>
          </div>
          </div>
        </div>

  @endif

        @endforeach
        <script  type="text/javascript">

        $('.movies_bt').click(function(){
        var movies_id =  $(this).attr("id");
        return FormsData('#simoid1',"/admincp/data/movies/post/"+movies_id,"POST",{ids:movies_id,},"api_Iteam_import")
        });

        </script>
