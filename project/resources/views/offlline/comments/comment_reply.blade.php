<div class="post-user-comment-box">
<div class="media">

<div class="media-body">
    <span class="m-0">{{$user}}</span>
    <span class="text-muted"><small>اضيف {{ $data->created_at->diffForHumans() }}
    </small></span>

</div>
</div>
<p>{{$data->comments}}</p>


    {{-- <div class='comments_{{$data->id}}'></div> --}}

    <div class="box-edit-user">

    {{-- likes --}}
    <a id="{{$data->id}}" class="mylike Function_{{$data->id}} btn btn-sm btn-link text-muted" likes='like'><i id="myFunction_{{$data->id}}" class="fa fa-thumbs-up"></i>
              <span id="v_{{$data->id}}">
                ({{count($likes)}})
               </span></a>

    {{-- end likes --}}

    </div>
</div>
{{-- <button class="btn1" ids='{{$data->id}}'>Prepend text</button>
'></div> --}}
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
