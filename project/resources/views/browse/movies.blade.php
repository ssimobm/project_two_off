@extends('master.main')
@section('content')

<div class="container-md mx-md-auto">
    <div class="row justify-content-center px-0"  id="results">
@foreach ($data as $k => $v)
       <x-generals.cardmovie :data="$v" />
@endforeach
  </div>
  <div class="row justify-content-center">
    {{$data->links('vendor.pagination.bootstrap-40')}}

  </div>
  </div>
@endsection
