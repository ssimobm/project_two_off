<!-- SignIn modal content -->
<div id="login-modal" class="modal fade show" tabindex="-10" role="dialog" aria-modal="true" style="display: block;">
  <div class="modal-dialog" role="document">
<div class="modal-content">
  <div id="guest">
    <div id="login" class="collapse show" aria-labelledby="logIn" data-parent="#guest" aria-controls="logIn">
      <div class="modal-body bg-dark">
        <div class="modal-header">
        <h4 class="modal-title" id="topModalLabel">{{__('Login')}}</h4>
        <button  type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>
         <x-generals.user.login logo="yes" />
      </div>
    </div>
    <div id="signup" class="collapse" aria-labelledby="SignUp" data-parent="#guest"aria-controls="SignUp">
      <div class="modal-body bg-dark">
        <div class="modal-header">
        <h4 class="modal-title" id="topModalLabel">{{__('Sign Up')}}</h4>
        <button  type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
         </div>

         <x-generals.user.signup logo="yes" />


      </div>
    </div>
</div>




</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">

$(".close").click(function(){
    $("#login-modal").remove();
  });

</script>
<!-- Signup modal content -->
