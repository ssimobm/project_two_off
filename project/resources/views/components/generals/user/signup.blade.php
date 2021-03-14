
                <div class="card  bg-pattern">

                    <div class="card-body p-m-4 p-2">

                        <div class="text-center w-75 m-auto">
                          @if ($logo)
                            <div class="auth-logo  w-100">
                                <a href="{{route('index')}}" class="text-center">
                                    <span class="logo-lg">
                                        <img src="{{asset('/logoo.png')}}" alt="" height="50">
                                    </span>
                                </a>
                            </div>

                            @else
                          <h2 class="card-title py-2">{{__('Sign Up')}}</h2>
                          @endif
                        </div>

                        <form method="POST" class="px-3" action="{{ route('register') }}">
@csrf
                          <div class="form-group  text-left">
                              <label for="name">{{ __('Full Name') }}</label>
                              <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required="" placeholder="{{__('Full Name')}}">
                                @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                          </div>
                          <div class="form-group  text-left">
                              <label for="username">{{ __('Username') }}</label>
                              <input class="form-control @error('username') is-invalid @enderror" type="text" name="username" required="" placeholder="{{__('Username')}}">
                                @if($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                          </div>

                            <div class="form-group  text-left">
                                <label for="email">{{ __('Email') }}</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" required="" placeholder="{{ __('Email') }}">
                                  @if($errors->has('email'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                                  @endif
                            </div>


                            <div class="form-group  text-left">
                                <label for="email_confirmation">{{ __('Email') }}</label>
                                <input class="form-control" type="email" name="email_confirmation" required="" placeholder="{{ __('Email') }}">
                                @if($errors->has('email_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group  text-left">
                                <label for="password">{{ __('Password') }}</label>
                                <input class="form-control" type="password" required="" name="password" placeholder="{{ __('Password') }}">
                                @if($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group  text-left">
                                <label for="confirm_password">{{ __('Confirm password') }}</label>
                                <input class="form-control @if($errors->has('password_confirmation')) is-invalid @endif"
                                    name="password_confirmation" type="password" required id="password_confirmation" placeholder="{{ __('Confirm password') }}" />

                                @if($errors->has('password_confirmation'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>

                            {{-- <div class="form-group  text-left">
                                <div class="custom-control custom-checkbox">
                                    <label class="custom-control-label" for="check_only">{{ __('I accept') }} <a href="#">{{ __('Terms and Conditions') }}</a></label>
                                    <input type="checkbox" class="custom-control-input" id="check_only">
                                </div>
                            </div> --}}

                            <div class="form-group  text-left text-center">
                                <button class="btn btn-primary" type="submit">{{ __('Sign Up') }}</button>
                            </div>

                        </form>

                        {{-- <div class="text-center">
                            <h5 class="mt-3 text-muted">Sign in with</h5>
                            <ul class="social-list list-inline mt-3 mb-0">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                </li>
                            </ul>
                        </div> --}}

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">{{__("Do You have an account?")}}
                        @if ($logo)
                          <a id="logIn" class="text-white ml-1" data-toggle="collapse" href="#login" aria-expanded="false">
                          {{__('login')}}</a>
                        @else
                          <a href="{{route('login')}}" class="text-white ml-1"><b>{{__('login')}}</b></a>

                        @endif
                      </p>




                    </div> <!-- end col -->
                </div>
                <!-- end row -->
