$.ajaxSetup({
  headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(".input-group").on("keyup input", function(){

types = $("#selectsherch option:selected").val();
search =  $(".top-search").val();

 $.ajax({
   url: "{{ url('search') }}",
   method:"POST",
   dataType: 'html',
   data:{search:search,types:types,},

	 success: function(data, status){if (status == "success")
 {
	 if (search.length >2) {
	 	$('#search-dropdown').html(data);
	}
	if (search.length < 3 ){
		$('#search-dropdown').html(data);


	}

     }
   }
  });
});


$('.owl-carousel').owlCarousel({
rtl:true,
loop:false,
margin:5,
nav:false,

responsiveClass:true,
autoplay:true,
autoplayTimeout:1500,
autoplayHoverPause:true,
responsive:{
  0:{
      items:2
  },
  480:{
      items:4
  },
  800:{
      items:5
  },
  1024:{
      items:6

  },

  1200:{
      items:7

  },
  1920:{
      items:9
  }
}
})


function simo(name,id,link,dato,title) {

  $.ajax({
  url: link,
  method:"POST",
  dataType: 'html',
  data:{id:id,type:name},
  success: function(data, status){if (status == "success")
  {
    toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-left",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
if (data == 'success') {
  toastr["success"]("تم حذف "+title+" ","نجاح");
}else {
   toastr["error"]("تم حذف "+title+" ","نجاح");
 }
 }}
  });

};

function view(data,id) {
  if (data === "delet") {
  //  $("#"+id).remove() ;
  }

}
$(".favorit").click( function(){

var id = $(this).attr("id");
var title = $(this).attr("titlee");
simoo =  simo("favorit",id,"Profile/Favorit/Add",view('favorit',id),title);
$("#SimoO").html(simoo);

 });
 $(".watchcon").click( function(){

 var id2 = $(this).attr("id");
 var title2 = $(this).attr("titlee");
 simoo2 =  simo("watchcon",id2,"Profile/watchcon/Add",view('watchcon',id2),title2);
 $("#SimoO3").html(simoo2);
         });

$(".watchlater").click( function(){

var id1 = $(this).attr("id");
var title1 = $(this).attr("titlee");
simoo1 =  simo("Watchlater",id1,"Profile/Watchlater/Add",view('Watchlater',id1),title1);
$("#SimoO2").html(simoo1);

          });

$(".notify").click( function(){

var id2 = $(this).attr("id");
var title2 = $(this).attr("titlee");
simoo2 =  simo("notify",id2,"Profile/Notify/Add",view('notify',id2),title2);
$("#SimoO3").html(simoo2);
        });

function TopModalSite(name_type,type_id,id,link,title,text,id_div) {
            if (type_id === name_type) {

              $(id_div).html('<div id="' + type_id + '" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"> <div class="modal-dialog modal-top"> <div class="modal-content"> <div class="modal-header"> <h4 class="modal-title" id="topModalLabel">'+title+'</h4> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> </div> <div class="modal-body"> '+text+' </div> <div class="modal-footer"> <button type="button" class="btn btn-light" data-dismiss="modal">Close</button> '+link+' </div> </div><!-- /.modal-content --> </div><!-- /.modal-dialog --> </div>');

            }};
