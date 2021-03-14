<div class="comment-area-box simo mt-2 mb-3" id="comment_0">
  <span class="input-icon"> <textarea rows="3" class="commento_0 form-control" placeholder="Write something..."></textarea> </span> <div class="comment-area-btn"> <div> <button type="submit" class="commento btn btn-sm btn-light text-black-50 btn-dark waves-effect waves-light" ids="0">Post</button> </div> </div>
  </div>
  <div id="comments_0"></div>
  @foreach ($comments as $key => $value)
  @php
  $comm = $value->where('id', $value->id)->first()->comment->sortByDesc('created_at');
  $comm1 = $value->where('id', $value->id)->where('parent_id', "0")->first();
  $simoo = $value->where('id', $value->id)->first()->user->name;
  $likes = $value->where('id', $value->id)->first()->Like->all() ;

  $likesimo = $value->where('id', $value->id)->first()->Like->where('user_id', $user_simo) ;
 $likesimo = $value->where('id', $value->id)->first()->Like->where('user_id',$user_simo)->first() ;

  @endphp
  @if (isset($comm))


    <div class="border border-light p-0 mb-0">
    <div class="media">

    <div  class="media-body m-0 p-1" id="commentsall_{{$value->id}}">
     <span  class="m-0">{{$simoo}}</span >
     <span class="text-muted"><small>اضيف {{ $value->created_at->diffForHumans() }}</small></span>
      </div >


    </div>
    <p   class="m-1 p-1">{{$value->comments}}</p>
  {{-- link --}}
   <div class="box-edit-user">
   {{-- likes --}}
      @if (isset($likes) and isset($user_simo))
   @foreach ($likes as $k2 => $v2)

    @if ($v2->user_id == $user_simo and $v2->liks == 1)
       <a id="{{$value->id}}" class="mylike Function_{{$value->id}} btn btn-sm btn-link text-muted" likes='unlike'><i id="myFunction_{{$value->id}}" class="fa fa-thumbs-up simocoll"></i>
        <span id="v_{{$value->id}}">
          ({{count($likes)}})
         </span></a>

  @else
    <a id="{{$value->id}}" class="mylike Function_{{$value->id}} btn btn-sm btn-link text-muted" likes='like'><i id="myFunction_{{$value->id}}" class="fa fa-thumbs-up"></i>
              <span id="v_{{$value->id}}">
                ({{count($likes)}})
               </span></a>
         @endif
     @endforeach
   @endif
  @if (count($likes) ==0 or ! isset($user_simo))

      <a id="{{$value->id}}" class="mylike Function_{{$value->id}} btn btn-sm btn-link text-muted" likes='like'><i id="myFunction_{{$value->id}}" class="fa fa-thumbs-up"></i>
                <span id="v_{{$value->id}}">
                  ({{count($likes)}})
                 </span></a>
  @endif

   {{-- end likes --}}

  <a href="#commentsall_{{$value->id}}" class="btn btn-sm btn-link text-muted"><div class="bcomment" ids="{{$value->id}}"><i class="fas fa-reply mr-1"></i> Reply</div></a>
  <a href="#commentsall_{{$value->id}}" class="btn btn-sm btn-link text-muted"><div class="bcommentall" ids="{{$value->id}}">
  <i class="fas fa-reply mr-1"></i> Reply aLL
 </div></a></div>
  <div id="comments_{{$value->id}}"></div>
  <div class="comment-area-box simo mt-2 mb-3" id="comment_{{$value->id}}">
  <span class="input-icon"> <textarea rows="3" class="commento_{{$value->id}} form-control" placeholder="Write something..."></textarea> </span> <div class="comment-area-btn"> <div> <button type="submit" class="commento btn btn-outline-blue btn-sm waves-effect waves-light" ids="{{$value->id}}">Post</button> </div> </div>
  </div>
  <div id="div_{{$value->id}}" class='comment-area-box simo'>

  @foreach ($comm as $k => $v)
    @php
    $likes1 = $value->where('id', $v->id)->first()->Like->all() ;

    @endphp
  <div class="bcomment" ids="{{$v->id}}"></div>
  <div class="post-user-comment-box">
  <div class="media">

  <div class="media-body">
     <span class="m-0">{{$simoo}}</span>
     <span class="text-muted"><small>اضيف {{ $v->created_at->diffForHumans() }}</small></span>

  </div>
  </div>
  <p>{{$v->comments}}</p>
  {{-- likes --}}

     @if (isset($likes1))
  @foreach ($likes1 as $k2 => $v2)

   @if ($v2->user_id == $user_simo and $v2->liks == 1)
      <a id="{{$v->id}}" class="mylike Function_{{$v->id}} btn btn-sm btn-link text-muted" likes='unlike'><i id="myFunction_{{$v->id}}" class="fa fa-thumbs-up simocoll"></i>
       <span id="v_{{$v->id}}">
         ({{count($likes1)}})
        </span></a>

 @else
   <a id="{{$v->id}}" class="mylike Function_{{$v->id}} btn btn-sm btn-link text-muted" likes='like'><i id="myFunction_{{$v->id}}" class="fa fa-thumbs-up"></i>
             <span id="v_{{$v->id}}">
               ({{count($likes1)}})
              </span></a>
        @endif
    @endforeach
  @endif
 @if (! isset($likes1))

     <a id="{{$v->id}}" class="mylike Function_{{$v->id}} btn btn-sm btn-link text-muted" likes='like'><i id="myFunction_{{$v->id}}" class="fa fa-thumbs-up"></i>
               <span id="v_{{$v->id}}">
                 ({{count($likes1)}})
                </span></a>
 @endif
  {{-- end likes --}}
  </div>

  @endforeach

  </div>
  </div>

  @endif
 @endforeach

  {{$comments->links('vendor.pagination.comment')}}


<div id="deletsimo" class="deletsimo">
  <script>

 $(document).ready(function(){
  $(".mylike").click(function(){
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    var likes = $(this).attr("likes");
    var likesid = $(this).attr("id");
    var like = $("#myFunction_"+likesid).attr("class");



 $.ajax({
 url: "{{ url('likes/add') }}/"+likes,
 method:"POST",
 dataType: 'html',
 data:{like:likes,idsimo:likesid,},
 success: function(data, status){if (status == "success")
 {
  $("#myFunction_"+likesid).toggleClass("simocoll");
  if (likes == 'like') {
  $(".Function_"+likesid).attr("likes","unlike");
  }else {
  $(".Function_"+likesid).attr("likes","like");
  }
  $("#v_"+likesid).html('('+data+')');
 console.log(data);

 }

 }


 });


  });
 });



  </script>

  <script  type="text/javascript">

  $(document).ready(function(){
  $(".loadcom").click(function(){

  page++;
      event.preventDefault();
  $("#deletsimo").remove();
    $(".deletsimo").remove();
       $.ajaxSetup({
         headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
       });



   siimo =  $(this).attr("idsimo");


    //var page = $(this).attr('page').split('page=')[1];


   $.ajax({
     url: "{{ url('comments/ajaxtest') }}/1",
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
