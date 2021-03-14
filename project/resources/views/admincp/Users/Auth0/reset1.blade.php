@extends('master.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                  @if (session('status'))
                      <div class="alert alert-success" role="alert">
                          {{ session('status') }}
                      </div>
                  @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-error" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form class="very_check" method="POST" action="{{ route('password.email') }}">
                        @csrf
<div class="row justify-content-center">


                        <div class="col-10 form-group">
                               <h4>Profile.email</h4>
                               <input type="email" class="email form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                           <span id="email_id">
                           </span>@error('email')
                               <span class="delet1 invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                               </div>

                            <div class="col-6 form-group">
                                <div id="submit"> </div>
                            </div>
</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
$(document).ready(function() {
$(".very_check").on("keyup click", function(e){

email = $(".email").val();



$.ajaxSetup({
 headers: {
	 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 }
});
 $.ajax({
   url: "{{url('auth/users/resets/error')}}",
   method:"POST",
   dataType: 'html',
   data:{email:email},

	 success: function(data, status){if (status == "success")
 {

   var datas= jQuery.parseJSON(data);
console.log(datas.email);
 $.each( datas, function( key, value ) {

if (value.length > 0) {
$('.delet1').remove();
$('.'+key).addClass("is-invalid");
$('.'+key).removeClass("is-valid ");
$('#'+key+'_id').show();
$('#'+key+'_id').html(value);
}else {
$('.'+key).removeClass("is-invalid");
$('.'+key).addClass("is-valid ");
$('#'+key+'_id').hide();
}

//if (datas.email.length+datas.namefirst.length+datas.user.length > 0) {

});

if (datas.email.length > 0) {
  $('#btn_sub').remove();
}else {
  $('#submit').html('<div id="btn_sub"><button type="submit" class="col-12 btn-submit btn btn-primary waves-effect waves-light">Save</button></div>');
}
     }
   }
  });
});
 });
</script>
@endsection
