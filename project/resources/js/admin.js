// config All Api
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
/////////////
page_count = 1;
$('.submit').click(function(){
page_count++;
return FormsData('#simoid1',"/data/movies/ajax/"+page_count,"POST",{page:page_count,})
});
$('.movies_bt').click(function(){
  var movies_id =  $(this).attr("id");
  return FormsData('#movies_bt',"/data/movies/post/"+movies_id,"POST",{ids:movies_id,},"api_Iteam_import")
});
$("#submit1").click(function(){
$(".movies_bt").each(function(){
  var movies_id =  $(this).attr("id");
  return FormsData('#movies_bt',"/data/movies/post/"+movies_id,"POST",{ids:movies_id,},"api_Iteam_import")
});
});
$('.submit').click(function(){
page_count++;
return FormsData('#simoid1',"/data/tvshows/ajax/"+page_count,"POST",{page:page_count,})
});
$('.tvshows_bt').click(function(){
var tvshows =  $(this).attr("id");
return FormsData('#tvshows_bt',"/data/tvshows/post/"+tvshows,"POST",{ids:tvshows,},"api_Iteam_import")
});
$(".submit1").click(function(){
$(".tvshows_bt").each(function(){
var tvshows =  $(this).attr("id");
return FormsData('#tvshows_bt',"/data/tvshows/post/"+tvshows,"POST",{ids:tvshows,},"api_Iteam_import")
});
});
$('.season_btn').click(function(){
  var season_id =  $(this).attr("season");
  var season_nm =  $(this).attr("id");
return FormsData('#simoid1',"/data/seasons/post/"+season_id,"POST",{ids:season_nm,},"api_Iteam_import")
});
$("#submit1").click(function(){
$(".season_btn").each(function(){
var season_id =  $(this).attr("season");
var season_nm =  $(this).attr("id");
return FormsData('#simoid1',"/data/seasons/post/"+season_id,"POST",{ids:season_nm,},"api_Iteam_import")
});
});
$('.episode_btn').click(function(){
  var episode_id =  $(this).attr("season");
  var episode_nm =  $(this).attr("id");
  var episode_tv =  $(this).attr("tv");
  return FormsData('#episode_btn',"/data/episodes/post/"+episode_tv+"/"+episode_id,"POST",{ids:episode_nm,},"api_Iteam_import")
});
$("#submit1").click(function(){
$(".episode_btn").each(function(){
  var episode_id =  $(this).attr("season");
  var episode_nm =  $(this).attr("id");
  var episode_tv =  $(this).attr("tv");
  return FormsData('#episode_btn',"/data/episodes/post/"+episode_tv+"/"+episode_id,"POST",{ids:episode_nm,},"api_Iteam_import")
});
});
/////////////
//end config All Api
