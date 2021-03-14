@extends('master.main')

@section('content')

<div class="container-xl mx-xl-auto">
  <div class="row  justify-content-center px-xl-2 px-md-4 px-0" id="simoid1">

  @foreach ($data as $v)
    @if (isset($Episodes->Where('season_nm',$v->season_number)->Where('tmdb_id',$Seasons->tmdb_id)->firstWhere('episode_nm',$v->episode_number)->episode_nm))
  @if ($Episodes->Where('season_nm',$v->season_number)->Where('tmdb_id',$Seasons->tmdb_id)->firstWhere('episode_nm',$v->episode_number)->episode_nm)

     <div class="col-lg-3 col-md-3 col-sm-4 col-6">
      <div class="card filmoqbox filmoq-box" >
        <img src="https://image.tmdb.org/t/p/w780{{$v->still_path}}" class="img-ep" alt="...">
        <div class="filmoq filmoq-blue filmoq-left"><span><i class="mdi mdi-access-point mr-1"></i> end</span></div>
        <div class="filmoq filmoq-blue filmoq-right">
          <span>{{$v->episode_number}}</span>
        </div>
          <div class="card-body">

            <h5 class="card-title">
              {{Str::limit($v->name, 20, '...')}}
            </h5>

          </div>
        </div>
          </div>

  @endif
   @else

     <div class="col-lg-3 col-md-3 col-sm-4 col-6">
       <div class="card filmoqbox filmoq-box">
         <img src="https://image.tmdb.org/t/p/w780{{$v->still_path}}" class="img-ep" alt="...">
         <div id='d{{$v->episode_number}}'>
           <div id='{{$v->episode_number}}'  class="episode_btn filmoq filmoq-blue filmoq-left" tv="{{$Seasons->tv_id}}" season="{{$Seasons->id}}"><span><i class="mdi mdi-access-point mr-1"></i> {{__('Add')}}</span></div>
         </div>
         <div class="filmoq filmoq-blue filmoq-right">
           <span>{{$v->episode_number}}</span>
         </div>
           <div class="card-body">
             <h5 class="card-title" idsimo="{{$v->episode_number}}">  {{Str::limit($v->name, 20, '...')}}</h5>

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

$('.episode_btn').click(function(){
  var episode_id =  $(this).attr("season");
  var episode_nm =  $(this).attr("id");
  var episode_tv =  $(this).attr("tv");
  return FormsData('#episode_btn',"/admincp/data/episodes/post/"+episode_tv+"/"+episode_id,"POST",{ids:episode_nm,},"api_Iteam_import")
});
$("#submit1").click(function(){
$(".episode_btn").each(function(){
  var episode_id =  $(this).attr("season");
  var episode_nm =  $(this).attr("id");
  var episode_tv =  $(this).attr("tv");
  return FormsData('#episode_btn',"/admincp/data/episodes/post/"+episode_tv+"/"+episode_id,"POST",{ids:episode_nm,},"api_Iteam_import")
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
