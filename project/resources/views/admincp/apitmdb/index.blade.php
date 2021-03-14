@extends('master.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@lang('tmdb.Tmdb_Setting')</div>

                <div class="card-body">


                <form method="POST" action="{{ url('/admincp/options/api/update') }}">
                    @csrf
                  <div class="form-group">
                    <label for="exampleInputEmail1">@lang('tmdb.Tmdb_code')</label>
                    <input type="text" class="form-control" name="datago[api]" value="{{$data->Simo_Op('option_name','tmdb_api')}}">
                  </div>

                     <div class="form-group">
                     <label for="exampleFormControlSelect1">@lang('tmdb.Tmdb_Lang')</label>
                     <select class="form-control" name="datago[lang]">
                       @foreach (unserialize($data->Simo_Op('option_name','tmdb_langAll')) as $key =>                    $value)

                       <option value="{{$key}}"
                   @if ($data->Simo_Op('option_name','tmdb_lang') === $key) selected @endif

                   >{{$value}}</option>

                   @endforeach

</select>
</div>

                  <button type="submit" class="btn btn-primary">@lang('post.save')</button>
                </form>
                  <script>
                $(document).ready(function(){
                	$("#ahmed").click(function(){

                        $(".siimo").each(function(){
                    var siimo =  $(this).attr("idsimo");


                    $.ajax({
                		type: "POST",
                		url: "insert.php",
                		data:{
            "_token": "{{ csrf_token() }}",
            name:siimo,

          },
                		beforeSend: function(){
                			$("#ahmed").css("background","#FFF url(https://phppot.com/demo/jquery-ajax-autocomplete-country-example/loaderIcon.gif) no-repeat 165px");
                		},


                		success:   function(data, status){if (status == "success") {

               }}

               });

               });

               });
               });
                </script>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
