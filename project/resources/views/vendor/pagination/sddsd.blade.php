<div class="submito row justify-content-center">


@if ($paginator->hasPages())
  @if ($paginator->hasMorePages())
  <div class="content">
      <div class="col-lg-12">
        <button type="button" class="btn btn-outline-danger width-xl waves-effect waves-light" id="submit" page="{{str_replace($_SERVER['HTTP_HOST']."?page=", "", $paginator->nextPageUrl())}}">Load </button>
</div> </div>
  @else
    <br>
  <div class="content">
  <div class="col-lg-12">
        <button type="button" class="btn btn-outline-danger width-xl waves-effect waves-light" disabled>Load</button>
 </div> </div>
  @endif
@endif

<script  type="text/javascript">
$(document).ready(function(){
$("#submit").click(function(){
    event.preventDefault();
  $(".submito").remove();
     $.ajaxSetup({
       headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
     });



 siimo =  $(this).attr("idsimo");
  $( "#submito" ).remove();

  var page = $(this).attr('page').split('page=')[1];


 $.ajax({
   url: "http://192.168.1.121/site2021/public/tvshows/loadajax",
   method:"GET",
   dataType: 'html',
   data:{page:page,},
   beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
   success: function(data, status){if (status == "success")
 {
  $('#simoid').html(data);


     }

   }


  });


});





     });

</script>





  </div>
