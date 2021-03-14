
var UserData = class {

  constructor(result=null) {
    this.result = result;
  }

  GetData(link,method,datas) {
                 //let siimo =  $(this).attr("idsimo");
            this.alldata  =  $.ajax({
                   url: link,
                   method:method,
                   dataType: 'html',
                   data:datas,
                  success: function(data, status){
                  if (status == "success") {
                  return  data ;
                   }}

               });
          }
  // functions filters
  get get() {

    let get_data = {
      alldata : this.alldata ,
      result : this.result ,
    } ;

    return {

      first : function (){
        return $(this.result).html(this.alldata);
      } ,
      delets_type : function (){
      return get_data.alldata.done(function(msg) {
       if (msg) {
        $(get_data.result).remove();
       }
      }) ;
      } ,
    }

    }
  // end functions filters
}

$(document).ready(function() {
  $.ajaxSetup({
    headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

// start profile user
$(".input-group").on("keyup input", function(){

types = $("#selectsherch option:selected").val();
search =  $(".top-search").val();

 $.ajax({
   url: "/search",
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

function simo(name,id,link,title) {
  console.log(name);
  let users = new UserData ;
  users.GetData(link,"POST",{id:id,type:name});
  let Getdata = users.alldata.done(function(data) {
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
  toastr["success"]("اضيف الى مكتبتي "+title+" ","نجاح");
}
if (data == 'exists') {
   toastr["error"](" موجود في مكتبتي "+title+" ","خطأ");
}
if (data == 'login') {
  $("#login-modal").modal('toggle');

}

  })
.fail(function(){
    $("#login-modal").modal('toggle');
  });
};

$(".favorit").click( function(){
var id = $(this).attr("id");
var title = $(this).attr("titlee");
var type = $(this).attr("types");
simoo =  simo(type,id,"/Profile/Favorit/Add",title);
});
 $(".watchcon").click( function(){
 var id2 = $(this).attr("id");
 var title2 = $(this).attr("titlee");
 var type = $(this).attr("types");
 simo("watchcon",id2,"/Profile/watchcon/Add",title2);
});

$(".watchlater").click( function(){
var id1 = $(this).attr("id");
var title1 = $(this).attr("titlee");
var type = $(this).attr("types");
simo(type,id1,"/Profile/Watchlater/Add",title1);
});

$(".notify").click( function(){
var id2 = $(this).attr("id");
var title2 = $(this).attr("titlee");
var type = $(this).attr("types");
simo(type,id2,"/Profile/Notify/Add",title2);
});

$(".delet_a").click( function(){
var id2 = $(this).attr("id");
var title2 = $(this).attr("titlee");
var type = $(this).attr("types");
simo(type,id2,"/Profile/Favorit/Delet",title2);
});
// end profile user
//keyup input mouseleave
function formusers(link,type,type2) {
  var inputs = $("#form-"+type2+" :input");
  data = {} ;
  $.each( inputs.serializeArray(), function( key, value ) {
    if (value.name != "_token") {
    data[value.name] = value.value ;
    }
  });

    let users = new UserData ;
    users.GetData(link,type,data);
    return users.alldata.done(function(data) {
    let datas= jQuery.parseJSON(data);


     $.each(datas.errors, function( key, value ) {
       console.log(value);
    if (value.length > 0) {
    $('[name="'+key+'"]').addClass("is-invalid");
    $('[name="'+key+'"]').removeClass("is-valid ");
    $('#'+key).show();
    $('#'+key).html(value);
    }else {
    $('[name="'+key+'"]').removeClass("is-invalid");
    $('[name="'+key+'"]').addClass("is-valid ");
    $('#'+key).hide();
    }
    });
 if (datas.very) {
   $('#btn_sub').remove();
   }
    else {
      $('#submit_get').html('<div id="btn_sub"><button type="submit" class="col-12 btn btn-blue">Save</button></div>');
    }
    }) ;

}

 //keyup input mouseleave
 function TopModalSite(name_type,type_id,id,link,title,text,id_div) {
   if (type_id === name_type) {

     $(id_div).html('<div id="' + type_id + '" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"> <div class="modal-dialog modal-top"> <div class="modal-content"> <div class="modal-header"> <h4 class="modal-title" id="topModalLabel">'+title+'</h4> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> </div> <div class="modal-body"> '+text+' </div> <div class="modal-footer"> <button type="button" class="btn btn-light" data-dismiss="modal">Close</button> '+link+' </div> </div><!-- /.modal-content --> </div><!-- /.modal-dialog --> </div>');

   }};
 $(".save_id").click( function(){
     id = '';
     name = $(this).attr("data-target").replace("#", "");
     link = '<div id="submit_get"></div>';
     title = 'Update User Confirm';
     text = '<h5>Update User Confirm</h5> <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula.</p>';
     color = 'btn-blue';
     id_div = "#show_save_id";
 TopModalSite('save_id',name,id,link,title,text,id_div);
  });
$("#form-users").on("keyup click", function(){
return formusers("/Profile/error","POST","users") ;
});
$("#form-pass").on("keyup click", function(){
return formusers("/auth/users/pass/error","POST","pass") ;
});
$(".click_deletall").on("click", function(){
let type = $(this).attr('typename');
let users = new UserData("#"+type+"_id") ;
users.GetData("/users/notifications","POST",{type:type});
users.get.delets_type();
});
$(".click_delet_select").on("click", function(){
let type = $(this).attr('typename');
let id = $(this).attr('id');
let users = new UserData("#"+type+"_"+id) ;
users.GetData("/users/notifications","POST",{type:type,id:id});
users.get.delets_type();
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
  1400:{
      items:8

  },
  1600:{
      items:9

  },
  1800:{
      items:10

  },
  1920:{
      items:12
  }
}
})
         })

// end slider
