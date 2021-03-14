@extends('master.main')

@section('content')

  <style>
  .card-body {
      flex: 1 1 auto;
      min-height: 1px;
      padding: 6px 0;
  }.card-title {
      margin-bottom: 5px;
  }.img-thumbnail {
          padding: 0!important;
      background-color: #ffffff;
      border: 0;
      border-radius: 0;
      height: 220px;
      width: 100%;
  }.card {
    PADDING: 0!important;
}
.ribbon-box .ribbon.float-left {
    margin-right: -10px;
    margin-left: auto;
    border-radius: 3px 0 0 3px;
}.ribbon-box .ribbon {
    position: absolute;
    clear: both;
    padding: 5px 12px;
    margin-bottom: 15px;
    box-shadow: 2px 5px 10px rgba(50,58,70,.15);
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    top: 20%;
}
.justify-content-center {
justify-content: center!important;
text-align: center;
}
  </style>
<div class="container mx-auto">
<div class="row justify-content-center">
@foreach ($data->seasons as $v)

  @if (isset($Seasons->Where('tmdb_id',$data->id)->firstWhere('season_nm',$v->season_number)->season_nm))
@if ($Seasons->firstWhere('tmdb_id',$data->id)->firstWhere('season_nm',$v->season_number)->tmdb_id)



  <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
    <div class="card filmoqbox filmoq-box" >
      <img src="https://image.tmdb.org/t/p/w780{{$v->poster_path}}" class="img-tv-movies" alt="...">
        <div class="card-body">
          <h5 class="card-title">
            {{Str::limit($v->name, 20, '...')}}
          </h5>
  <div class="filmoq filmoq-blue filmoq-left"><span><i class="mdi mdi-access-point mr-1"></i> end</span></div>
  <div class="filmoq filmoq-blue filmoq-right">
    <span>{{$v->season_number}}</span>
  </div>
        </div>
      </div>
        </div>

@endif
 @else

   <div class="col-lg-2 col-md-3 col-sm-4 col-6">
     <div class="card filmoqbox filmoq-box">
       <img src="https://image.tmdb.org/t/p/w780{{$v->poster_path}}" class="img-thumbnail d-block" alt="...">
         <div class="card-body">
           <h5 class="card-title">  {{Str::limit($v->name, 20, '...')}}</h5>
         </div>
         <div id='d{{$v->season_number}}'>
           <div id='{{$v->season_number}}'  class="season_btn filmoq filmoq-blue filmoq-left" season="{{$TvShows->id}}"><span><i class="mdi mdi-access-point mr-1"></i> {{__('Add')}}</span></div>
         </div>
         <div class="filmoq filmoq-blue filmoq-right">
           <span>{{$v->season_number}}</span>
         </div>

         </div></div>
  @endif
@endforeach




</div>
<div class="row justify-content-center">
  <button id='submit1' class="submit1 col-3 btn btn-outline-blue btn-sm waves-effect waves-light" type="button" >
Import All Data   </button>

 </div>
</div>
<script  type="text/javascript">

$('.season_btn').click(function(){
  var season_id =  $(this).attr("season");
  var season_nm =  $(this).attr("id");
return FormsData('#simoid1',"/admincp/data/seasons/post/"+season_id,"POST",{ids:season_nm,},"api_Iteam_import")
});
$("#submit1").click(function(){
$(".season_btn").each(function(){
var season_id =  $(this).attr("season");
var season_nm =  $(this).attr("id");
return FormsData('#simoid1',"/admincp/data/seasons/post/"+season_id,"POST",{ids:season_nm,},"api_Iteam_import")
});
});

var AllData = class {
type;
result;
alldata;
  constructor(type,result,alldata) {
    this.type = type;
    this.result = result;
    this.alldata = alldata;
  }
  filter() {
    if (this.type === "api_Iteam_import") {
    return this.api_Iteam_import() ;
    }
  }

  sayHi() {
    return this.type;
  }
  api_Iteam_import() {

  if (this.alldata) {
    $("#d"+this.alldata).html('<div class="filmoq filmoq-blue filmoq-left" ><i class="mdi mdi-access-point mr-1"></i> end</div>');
    $("#p"+this.alldata).remove();
  }

  }


}
  function FormsData(result,link,method,datas,functions=null) {
                 //let siimo =  $(this).attr("idsimo");
                 $.ajax({
                   url: link,
                   method:method,
                   dataType: 'html',
                   data:datas,
                   beforeSend: function (key,value) {
                     console.log(value.data);
            return (value.data == "page=undefined") ? "" : value
        },
                   success: function(data, status){if (status == "success")
                   {

                     if (functions && data) {

                       (new AllData(functions,result,data)).filter() ;
                     }else {
                      $(result).html(data);
                     }

                   }

                   }

               });
          }
</script>

@endsection
