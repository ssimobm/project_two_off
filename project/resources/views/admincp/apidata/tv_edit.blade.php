@extends('master.main')

@section('content')
<div class="container-xl mx-xl-auto">
  <div class="row justify-content-center mx-auto">
    <button id='submit1' class="col-md-4 col-12 submit1 btn btn-outline-blue btn-sm waves-effect waves-light" type="button" >
  Import All Data   </button>
  <button id='submit' class="col-md-4 col-12  submit btn btn-outline-blue btn-sm waves-effect waves-light" type="button" >
  Load Data
   </button>
   </div>
    <div class="row  justify-content-center  mx-auto" id="simoid1">

@if (isset($Tvshows))
@foreach ($data as $v)

@if (isset($v->id))
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
  @endif
</div>
<div class="row justify-content-center">
<button id='submit' class="col-md-4 col-12  submit btn btn-outline-blue btn-sm waves-effect waves-light" type="button" >
Load Data
 </button>
 </div>
 <div class="row justify-content-center">
  {{$Tvshows->links('vendor.pagination.bootstrap-40')}}
  </div>
</div>
<script  type="text/javascript">
// page_count = 1;
// $('.submit').click(function(){
// page_count++;
// return FormsData('#simoid1',"/admincp/data/tvshows/ajax/"+page_count,"POST",{page:page_count,})
// });
$('.tvshows_bt').click(function(){
var tvshows =  $(this).attr("id");
return FormsData('#tvshows_bt',"/admincp/data/tvshows/post/"+tvshows,"POST",{ids:tvshows,},"api_Iteam_import")
});
$(".submit1").click(function(){
$(".tvshows_bt").each(function(){
var tvshows =  $(this).attr("id");
return FormsData('#tvshows_bt',"/admincp/data/tvshows/post/"+tvshows,"POST",{ids:tvshows,},"api_Iteam_import")
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
    $("#d"+this.alldata).html('<div class="filmoq-two-two filmoq-two-two-blue"> <span><i class="mdi mdi-access-point mr-1"></i> end</span> </div>');
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
