@extends('master.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                  @can ('create', "App\User")
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                      <h2></h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                  </div>
              </div>
                  @endcan

                  @cannot('create', "App\User")
                    <div class="card-header">

                      <div class="button-list">
                      					                     <!-- Log In modal -->
                      					                     <a type="button" class="btn btn-blue btn-xs nav-link  nav-user mr-2" data-toggle="modal" data-target="#login-modal">LogIn <i class="fas fa-key"></i></a>
                      					                       </div>
                  </div>
                  @endcannot
        </div>
    </div>
</div>
@endsection
