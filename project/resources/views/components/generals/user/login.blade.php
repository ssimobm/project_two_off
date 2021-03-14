
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
                          <h2 class="card-title py-2">{{__('Login User')}}</h2>
                          @endif
                        </div>

                        <form action="{{route('login')}}" method="POST" novalidate>
                            @csrf

                            <div class="form-group text-left mb-3">
                                <label for="emailaddress">{{__('User Name')}}</label>
                                <input class="form-control  @if($errors->has('login')) is-invalid @endif" name="login" type="text"
                                    id="emailaddress" required
                                    value="{{ old('login')}}"
                                    placeholder="{{__('Enter User Name')}}" />

                                    @if($errors->has('login'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group text-left mb-3">
                                <a href="{{route('login')}}" class="text-muted float-right"><small>{{__('Forgot your
                                    password?')}}</small></a>
                                <label for="password">{{__('Password')}}</label>
                                <div class="input-group input-group-merge @if($errors->has('password')) is-invalid @endif">
                                    <input class="form-control @if($errors->has('password')) is-invalid @endif" name="password" type="password" required
                                        id="password" placeholder="{{__('Enter your password')}}" />
                                        <div class="input-group-append" data-password="false">
                                        <div class="input-group-text">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                @if($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group text-left mb-3">
                                <div class="custom-control custom-checkbox">
                                    <inpu name="remember" type="checkbox" class="custom-control-input" id="checkbox-signin">
                                    <label class="custom-control-label" for="checkbox-signin">{{__('Remember me')}}</label>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit">{{__('Log In')}}</button>
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
{{--
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p> <a href="{{ route('password.request') }}" class="text-white-50 ml-1">{{__('Forgot your
                            password?')}}</a></p>
                        <p class="text-white-50">{{__("Don't have an account?")}}
                        @if ($logo)
                          <a id="SignUp" class="text-white ml-1" data-toggle="collapse" href="#signup" aria-expanded="false">
                          {{__('Sign Up')}}</a>
                        @else
                          <a href="{{route('register')}}" class="text-white ml-1"><b>{{__('Sign Up')}}</b></a>

                        @endif
                      </p>




                    </div> <!-- end col -->
                </div> --}}
                <!-- end row -->
