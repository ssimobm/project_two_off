@extends('master.main')
{{-- //@section('title', $tiles." - ".__('settings.setting')) --}}

@section('content')
<div class="container">
  <div class="row py-3">
<div class="col-lg-4 col-md-4 col-sm-12 col-12 py-1">
  <ul  class="list-group">
  <a href="{{ url('Profile/Edit') }}" class="list-group-item list-group-item-action"><i class="fas fa-user-edit mr-1"></i>Account Settings</a>
  <a href="{{ url('auth/users/pass') }}"  class="list-group-item list-group-item-action active_blue"  ><i class="fas fa-key mr-1"></i> Edit Password</a>
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

          <form id="form-pass" method="POST" action="{{ url('auth/users/pass') }}">

<div class="row justify-content-center">
@csrf

              <div class="col-10 form-group">
                     <h4>Profile.Password</h4>
                     <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password" autofocus>
                 <div id="password" class="invalid-feedback" role="alert">
                   @error('password')
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>
                   @enderror
                 </div>
                     </div>

                     <div class="col-10 form-group">
                            <h4>Profile.Password_confirmation</h4>
                            <input type="password" class="form-control password_confirmation @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  required autocomplete="password_confirmation" autofocus>
                        <div id="password_confirmation" class="invalid-feedback" role="alert">
                          @error('password_confirmation')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
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

@endsection
