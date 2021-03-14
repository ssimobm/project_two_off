@extends('master.main')
@section('content')
  <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-pattern">

              <div class="card-body p-4">

                  <div class="text-center w-75 m-auto">
                      <div class="auth-logo">
                        <a href="{{route('index')}}" class="text-center">
                            <span class="logo-lg">
                                <img src="{{asset('/logoo.png')}}" alt="" height="50">
                            </span>
                        </a>

                      </div>

                      <h2 class="card-title py-2">{{ __('Reset Password') }}</h2>

                      @if (session('status'))
                        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                          {{ session('status') }}
                                    </div>
                      @endif
                  </div>

                  <form method="POST" action="{{ route('password.email') }}">
                      @csrf
                      <div class="form-group mb-3">
                          <label for="email">Email address</label>
                          <input class="form-control" type="email" name="email" required="" placeholder="Enter your email">
                          @if($errors->has('email'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                          @endif
                      </div>

                      <div class="form-group mb-0 text-center">
                          <button class="btn btn-primary btn-block" type="submit">{{ __('Send Password Reset Link') }}</button>
                      </div>
                  </form>

              </div> <!-- end card-body -->
          </div>
          <!-- end card -->

          <div class="row mt-3">
              <div class="col-12 text-center">
                  <p class="text-white-50">Back to <a href="{{ route('login') }}" class="text-white ml-1"><b>Log in</b></a></p>
              </div> <!-- end col -->
          </div>
          <!-- end row -->

      </div> <!-- end col -->
  </div>
@endsection
