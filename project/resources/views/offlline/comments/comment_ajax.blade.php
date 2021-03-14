@extends('master.main')

@section('content')
  <style>

  .comment-area-box.simo  {
    display:none;
  }i.fas.fa-reply.mr-1 {

      margin-left: 0!important;
  }button.btn.btn-info.btn-sm {
      font-size: 10px;
      padding: 2px;

  }.post-user-comment-box {
      background-color: #f3f7f9;
      margin: 5px 0px 2px 0px!important;
      padding: 10px 5px 1px 5px!important;
      margin-top: 20px;
  }p.text-muted {
      margin-bottom: 2px;
  }
  </style>


    <div class="row justify-content-center">
    <div class="bcomment" ids='0'>
  <button type="button" class="btn btn-info waves-effect waves-light"><i class="mdi mdi-cloud-outline mr-1"></i> New Comment</button>
  </div></div>

  <div class="comment-area-box simo mt-2 mb-3" id="comment_0">
  <span class="input-icon"> <textarea rows="3" class="commento_0 form-control" placeholder="Write something..."></textarea> </span> <div class="comment-area-btn"> <div> <button type="submit" class="commento btn btn-sm btn-light text-black-50 btn-dark waves-effect waves-light" ids="0">Post</button> </div> </div>
  </div>
  <div id="comments_0"></div>
  @foreach ($comments as $key => $value)
@php
$comm = $value->where('id', $value->id)->first()->comment->sortByDesc('created_at');
$comm1 = $value->where('id', $value->id)->where('parent_id', "0")->first();
$simoo = $value->where('id', $value->id)->first()->user->name;
@endphp
@if (isset($comm->first()->id))


<div class="border border-light p-1 mb-0">
<div class="media">

<div  class="media-body">
    <span  class="m-0">{{$simoo}}</span >
    <span class="text-muted"><small>اضيف {{ $value->created_at->diffForHumans() }}</small></span>

</div >
</div>
<p>{{$value->comments}}</p>

<button class="btn btn-info btn-sm"><div class="bcomment" ids="{{$value->id}}"><i class="fas fa-reply mr-1"></i> Reply</div></button>
<button class="btn btn-info btn-sm"><div class="bcommentall" ids="{{$value->id}}">
<i class="fas fa-reply mr-1"></i> Reply aLL
</div></button>
<div id="comments_{{$value->id}}"></div>
<div class="comment-area-box simo mt-2 mb-3" id="comment_{{$value->id}}">
<span class="input-icon"> <textarea rows="3" class="commento_{{$value->id}} form-control" placeholder="Write something..."></textarea> </span> <div class="comment-area-btn"> <div> <button type="submit" class="commento btn btn-sm btn-light text-black-50 btn-dark waves-effect waves-light" ids="{{$value->id}}">Post</button> </div> </div>
</div>
<div id="div_{{$value->id}}" class='comment-area-box simo'>

@foreach ($comm as $k => $v)
  <div class="bcomment" ids="{{$v->id}}"></div>
  <div class="post-user-comment-box">
  <div class="media">

  <div class="media-body">
      <span class="m-0">{{$simoo}}</span>
      <span class="text-muted"><small>اضيف {{ $v->created_at->diffForHumans() }}</small></span>

  </div>
  </div>
  <p>{{$v->comments}}</p>

</div>

@endforeach

</div>
</div>

@endif
@if (isset($comm1->id) and ! isset($comm->first()->id))


  <div class="border border-light p-1 mb-0">
  <div class="media">

  <div  class="media-body">
      <span  class="m-0">{{$simoo}}</span >
      <span class="text-muted"><small>اضيف {{ $value->created_at->diffForHumans() }}</small></span>

  </div >
  </div>
  <p>{{$value->comments}}</p>

  <button class="btn btn-info btn-sm"><div class="bcomment" ids="{{$value->id}}"><i class="fas fa-reply mr-1"></i> Reply</div></button>
  <button class="btn btn-info btn-sm"><div class="bcommentall" ids="{{$value->id}}">
  <i class="fas fa-reply mr-1"></i> Reply aLL
  </div></button>
  <div class="comment-area-box simo mt-2 mb-3" id="comment_{{$value->id}}">
  <span class="input-icon"> <textarea rows="3" class="commento_{{$value->id}} form-control" placeholder="Write something..."></textarea> </span> <div class="comment-area-btn"> <div> <button type="submit" class="commento btn btn-sm btn-light text-black-50 btn-dark waves-effect waves-light" ids="{{$value->id}}">Post</button> </div> </div>
  </div>
  <div id="div_{{$value->id}}" class='comment-area-box simo'>
    <div id="comments_{{$value->id}}"></div>


  </div>
  </div>

@endif




  @endforeach

  <div  id="simoid1">
</div>

  {{$comments->links('vendor.pagination.comment')}}

<script type="text/javascript">
    page = '1';
</script>

<div id="deletsimo" class="deletsimo">
  <script  type="text/javascript">

  $(document).ready(function(){
  $(".loadcom").click(function(){
  page++;
      event.preventDefault();
  $("#deletsimo").remove();
      $(".deletsimo").remove();
       $.ajaxSetup({
         headers: {
           'X-CSRF-TOKEN': '{{ csrf_token() }}',
         }
       });



   siimo =  $(this).attr("idsimo");


    //var page = $(this).attr('page').split('page=')[1];


   $.ajax({
     url: "{{ url('comments/ajaxtest') }}/1?pages="+page,
     method:"POST",
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
    $('#simoid1').append(data);


       }

     }


    });


  });
   });
   $(document).ready(function(){
     $(".bcommentall").click(function(){
      var comment_id = $(this).attr("ids");
      $('#div_'+comment_id).slideToggle();
            $(".comment-area-box.simo:visible").not('#div_'+comment_id).show();
});
    $(".bcomment").click(function(){
     var comment_id = $(this).attr("ids");
     $('#comment_'+comment_id).slideToggle();
           $(".comment-area-box.simo:visible").not('#comment_'+comment_id).show();
});
});
  </script>
  <script>

  simo = '1';
  url = "http://localhost/site2022/public/comments/{{ $movies->id }}";
  $(document).ready(function(){
  $(".commento").click(function(){
    simo++;
    var comment_id = $(this).attr("ids");
  var commento =  $(".commento_"+comment_id).val();


       $.ajaxSetup({
         headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
       });
   $.ajax({
     url: "http://localhost/site2022/public/comments/{{ $movies->id }}",
     method:"POST",
     dataType: 'html',
     data:{comment:commento,co_id:comment_id},
     success: function(data, status){if (status == "success")
   {
    $('#comments_'+comment_id).after(data);

   $('#comment_'+comment_id).hide();
   $('.commento_'+comment_id).val("");


       }

     }


    });


  });
   });
  </script>
</div>




  <script>

  $(document).ready(function(){
  $(".silink").click(function(e) {
      e.preventDefault();

       iframesimo =  $(this).attr("href");
     $('.resp-container').html('<div id="loader1" class="d-flex justify-content-center"> <div class="spinner-border avatar-lg text-blue m-2" role="status"></div></div><iframe class="resp-iframe" src="'+ iframesimo +'" gesture="media" allow="encrypted-media" allowfullscreen="" ></iframe>');
      });
     $('.resp-iframe').on('load', function () {
  $('#loader1').hide();

     });
     });

     </script>





@endsection
