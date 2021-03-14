@extends('master.main')
@section('content')

<div class="container-md mx-md-auto">
    <div class="row justify-content-center px-0"  id="results">
@foreach ($data as $k => $v)
       <x-generals.cardepisode :data="$v" />
@endforeach

{{-- <div class="simoid" id="simoid"> --}}


{{--
  <style>
     .wrapper > ul#results li {
       margin-bottom: 2px;
       background: #e2e2e2;
       padding: 20px;
       width: 97%;
       list-style: none;
     }
     .ajax-loading{
       text-align: center;
     }
  </style> --}}
{{--
  <script>

      function simo(name,id,link,dato,title) {
      $(document).ready(function(){
        $.ajaxSetup({
          headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
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
      });
      };

      function view(data,id) {
        if (data === "delet") {
        //  $("#"+id).remove() ;
        }

      }
  </script>

  <div class="s_delet">
    <script type="text/javascript">

    $(".favorit").click( function(){

    var id = $(this).attr("id");
    var title = $(this).attr("titlee");
    simoo =  simo("favorit",id,"{{ url('Profile/Favorit/Add') }}",view('favorit',id),title);
    $("#SimoO").html(simoo);

     });
     $(".watchcon").click( function(){

     var id2 = $(this).attr("id");
     var title2 = $(this).attr("titlee");
     simoo2 =  simo("watchcon",id2,"{{ url('Profile/watchcon/Add') }}",view('watchcon',id2),title2);
     $("#SimoO3").html(simoo2);
             });

    $(".watchlater").click( function(){

    var id1 = $(this).attr("id");
    var title1 = $(this).attr("titlee");
    simoo1 =  simo("Watchlater",id1,"{{ url('Profile/Watchlater/Add') }}",view('Watchlater',id1),title1);
    $("#SimoO2").html(simoo1);

              });

    $(".notify").click( function(){

    var id2 = $(this).attr("id");
    var title2 = $(this).attr("titlee");
    simoo2 =  simo("notify",id2,"{{ url('Profile/Notify/Add') }}",view('notify',id2),title2);
    $("#SimoO3").html(simoo2);
            });

    </script> --}}
  </div>
  <div class="row justify-content-center">
    {{$data->links('vendor.pagination.bootstrap-40')}}

  </div>
  </div>
@endsection
