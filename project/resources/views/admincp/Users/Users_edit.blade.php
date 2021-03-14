@extends('master.main')
{{-- //@section('title', $tiles." - ".__('settings.setting')) --}}

@section('content')
<div class="container">
  <div class="row py-4">
    <div class="col-lg-4 col-md-4 col-sm-12 col-12 py-1">
  <ul  class="list-group">
    <a href="{{ url('/admincp/options/users') }}" class="list-group-item list-group-item-action"><i class="fas fa-users mr-1"></i>All Users</a>
  <a href="{{ url('/admincp/options/users/edit/') }}/{{$user->id}}" class="list-group-item list-group-item-action active_blue"><i class="fas fa-user-edit mr-1"></i>Account Settings</a>
  <a href="{{ url('/admincp/options/users/pass/') }}/{{$user->id}}"  class="list-group-item list-group-item-action"  ><i class="fas fa-key mr-1"></i> Edit Password</a>
</ul>


{{-- end list --}}
</div>
<div class="col-lg-8 col-md-8 col-sm-12 col-12 py-0">
  <div class="card">
      <div class="card-header">{{ __('Reset Password') }}</div>

      <div class="card-body">
          @if (session('success'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        {{ session('success') }}
            </div>

          @endif

          <form  class="form-users"   method="POST" action="{{ url('/admincp/options/users/edit/') }}/{{$user->id}}">
            @csrf
            <div class="row justify-content-center">
              <div class="col-12 form-group">
              <h4 >@lang('Profile.user')</h4>
              <input type="text" class="form-control"  placeholder="Enter @lang('Profile.user')" value="{{ $user->username }}" readonly>
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>

              </div>


               <div class="col-12 form-group">
               <h4 >@lang('Profile.email')</h4>
               <input type="email" name='email' class="types form-control @error('email') is-invalid @else is-valid @enderror" placeholder="Enter @lang('Profile.email')" value="{{ old('email', $user->email) }}" autocomplete="off" required="">
               {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
               <div id="email" class="invalid-feedback" role="alert">
               @error('email'){{ $message }}@enderror
               </div>
               </div>


               <div class="col-12 form-group">
               <h4 >@lang('Profile.email_confirmation')</h4>
               <input type="email" name='email_confirmation' class="types form-control @error('email_confirmation') is-invalid @else is-valid @enderror"  placeholder="Enter @lang('Profile.users')" value="{{ old('email_confirmation', $user->email) }}" autocomplete="email" required="">
               {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
               <div id="email_confirmation" class="invalid-feedback" role="alert">
               @error('email_confirmation'){{ $message }} @enderror
               </div>
               </div>



           <div class="col-12 form-group">
           <h4 >@lang('Profile.name_first')</h4>
           <input type="text" name='namefirst' class="types form-control @error('namefirst') is-invalid @else is-valid @enderror"  placeholder="Enter @lang('Profile.name')" value="{{ old('namefirst', $user->name) }}" autocomplete="off" required="">
           {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
           <div id="namefirst" class="invalid-feedback" role="alert">
           @error('namefirst'){{ $message }}@enderror
           </div>
           </div>

           <div class="col-12 form-group">
      <h4 >@lang('Profile.name_select_role')</h4>
     <select class="select_role form-control" name="select_role">
       @foreach ($roles as $k => $v)
           @if (isset($v->type))
           @if ($v->type === $user->UserMeta->UserRole->type)
          <option value='{{$v->id}}' selected>{{$v->name}}</option>
          @else
             <option value='{{$v->id}}'>{{$v->name}}</option>
           @endif
           @endif


       @endforeach
     </select>
     <div id="select_role" class="invalid-feedback" role="alert">
     @error('select_role'){{ $message }}@enderror
     </div>
          </div>

           <div class="col-12 form-group">
                  <h4>settings.user_active</h4>
                  <div class="radio radio-success form-check-inline py-2">
    <input class="activedate" type="radio" name="activedate"  value="True" @if ($user->email_verified_at)checked @endif required>
                         <label> Yes </label>
                         </div>
                 <div class="radio radio-pink form-check-inline">
                        <input class="activedate" type="radio" name="activedate" value="False"  @if (!$user->email_verified_at)checked @endif required>
                        <label> No </label>
                        </div>

                        <div id="activedate" class="invalid-feedback" role="alert">
                        @error('activedate'){{ $message }}@enderror
                        </div>
              </div>

              <div class="col-6 form-group">
                <div id="show_save_id">
                </div>
                <a  class="save_id col-4 btn-submit btn btn-blue waves-effect waves-light" data-toggle="modal" data-target="#save_id">Save</a>
              </div>



          </div>

          </form>
      </div>
  </div>

  {{-- end form --}}
</div>
</div>


<script type="text/javascript">







//////////////////


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



 //keyup input mouseleave
 function formusers(link,type) {
   var inputs = $(".form-users :input");
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
     console.log(datas.very);
  if (datas.very) {
      $('#btn_sub').remove();
    }
     else {
       $('#submit_get').html('<div id="btn_sub"><button type="submit" class="col-12 btn-submit btn btn-primary waves-effect waves-light">Confirm Save</button></div>');
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
 $(".form-users").on("keyup click", function(){
 return formusers("/Profile/error","POST") ;
 });

///////////////////////
// $(document).ready(function() {
// $(".form-groupss").on("keyup click", function(e){
// email = $(".email").val();
// email_confirmation = $(".email_confirmation").val();
// namefirst = $(".namefirst").val();
// select_role = $(".select_role").val();
// user = $(".user").val();
// $(".activedate").on("click", function(e){
// activedate = $(".activedate").attr('value');
// });
//  console.log(activedate);
//
// $.ajaxSetup({
//  headers: {
// 	 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//  }
// });
//  $.ajax({
//    url: "{url('/admincp/options/users/error') }}",
//    method:"POST",
//    dataType: 'html',
//    data:{select_role:select_role,activedate:activedate,email_confirmation:email_confirmation,email:email,namefirst:namefirst,user:user,},
//
// 	 success: function(data, status){if (status == "success")
//  {
//
//    var datas= jQuery.parseJSON(data);
//
//  $.each( datas, function( key, value ) {
//
// if (value.length > 0) {
// $('.'+key).addClass("is-invalid");
// $('.'+key).removeClass("is-valid ");
// $('#'+key).show();
// $('#'+key).html(value);
// }else {
// $('.'+key).removeClass("is-invalid");
// $('.'+key).addClass("is-valid ");
// $('#'+key).hide();
// }
//
// if (datas.email.length+datas.namefirst.length+datas.user.length > 0) {
//   $('#btn_sub').remove();
// }else {
//   $('#submit').html('<div id="btn_sub"><button type="submit" class="col-12 btn-submit btn btn-primary waves-effect waves-light">Confirm Save</button></div>');
// }
// });
//
//
//      }
//    }
//   });
// });
//  });
</script>
@endsection
