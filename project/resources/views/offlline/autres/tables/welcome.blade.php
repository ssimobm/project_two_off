@extends('master.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

          @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <a href="{{ url('/home') }}">Home</a>
                            @else
                              <div class="button-list">
                               <button type="button" class="btn btn-info" data-toggle="modal" data-target="#login-modal">Log In Modal</button>
                               </div>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif


        </div>
    </div>
</div>
@endsection
