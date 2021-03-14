@extends('master.main')
{{-- //@section('title', $tiles." - ".__('settings.setting')) --}}

@section('content')
<div class="container">
  <div class="row py-4">
    <div class="col-lg-4 col-md-4 col-sm-12 col-12 py-1">
  <ul  class="list-group">
  <a href="{{ url('Profile/Edit') }}" class="list-group-item list-group-item-action active_blue"><i class="fas fa-user-edit mr-1"></i>Account Settings</a>
  <a href="{{ url('auth/users/pass') }}"  class="list-group-item list-group-item-action"  ><i class="fas fa-key mr-1"></i> Edit Password</a>
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

          <form id="form-users"  action="{{ url('Profile/Edit') }}" method="post">
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
