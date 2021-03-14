@extends('master.main')

@section('content')
  <style >
  .simocoll {
  color: #f1556c;
}.box-edit-user {
    background: #252d35;
}
  </style>
<div class="container">
    <div class="row justify-content-center">
      <div class="border border-light">
        <div class="media  p-1 mb-0">
              <img class="mr-2 avatar-sm rounded-circle" src="http://localhost/site2022/public/assets/images/users/user-3.jpg" alt="Generic placeholder image">
              <div class="media-body">
                  <h5 class="m-0">Jeremy Tomlinson</h5>
                  <p class="text-muted"><small>about 2 minuts ago</small></p>
              </div>
          </div>
          <p class="p-1 mb-1">Story based around the idea of time lapse, animation to post soon!</p>

<div class="box-edit-user">
  <a href="javascript: void(0);" class="btn btn-sm btn-link text-muted"><i class="mdi mdi-reply"></i> Reply</a>

<a href="javascript: void(0);" class="btn btn-sm btn-link text-muted"><i class="mdi mdi-share-variant"></i> Share</a>
      @if (isset($like->liks))
@if ($like->liks == 1)
  <a id="Function" class="myFunction btn btn-sm btn-link text-muted" likes='unlike'><i id="myFunction" class="fa fa-thumbs-up simocoll"></i>
   <span id="simo">
     ({{$likes}})
    </span></a>
  @else

    <a id="Function" class="myFunction btn btn-sm btn-link text-muted" likes='like'><i id="myFunction" class="fa fa-thumbs-up"></i>   <span id="simo">
         ({{$likes}})
        </span>
      </a>
@endif

     @else
    <a id="Function" class="myFunction btn btn-sm btn-link text-muted" likes='like'><i id="myFunction" class="fa fa-thumbs-up"></i>
  <span id="simo">
        ({{$likes}})
       </span></a>
      @endif
</div></div>

  <script>

$(document).ready(function(){
  $("#Function").click(function(){
    var likes = $(this).attr("likes");
    var like = $("#myFunction").attr("class");


$.ajaxSetup({
  headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$.ajax({
url: "{{ url('likes/add') }}",
method:"POST",
dataType: 'html',
data:{like:likes,},
success: function(data, status){if (status == "success")
{
  $("#myFunction").toggleClass("simocoll");
  if (likes == 'like') {
  $("#Function").attr("likes","unlike");
  }else {
  $("#Function").attr("likes","like");
  }
  $("#simo").html('('+data+')');
console.log(data);

}

}


});


  });
});



  </script>

    </div>
</div>
@endsection
