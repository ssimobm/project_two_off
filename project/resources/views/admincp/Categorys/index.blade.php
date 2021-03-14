@extends('master.main')

@php

@endphp
@section('content')

<div class="container">
<div class="row">
  <div class="col-12">
    <div class="table-responsive">
      <table class="table table-dark text-white mb-0">
    <thead class="bg-primary">
    <tr>
        <th>id</th>
        <th>Names</th>
        <th>Edit/Delet</th>
    </tr>
    </thead>
    <tbody>
      @foreach ($Categorys as $key => $value)
        @if (isset($value))
<tr class="bg-custom">
    <th scope="row">{{$value->id}}</th>
    <td>{{$value->name}}</td>
    <td>
      <div class="btn-group mb-2">
       <a type="button" class="btn btn-light" href='{{ url('/admincp/Categorys/delet/') }}/{{$value->id}}'>Delet</a>
       <a type="button" class="btn btn-light" href='{{ url('/admincp/Categorys/edit/') }}/{{$value->id}}'>Edit</a>
      </div>
    </td>
</tr>
  @endif
  @endforeach




    </tbody>
      </table>
                                    </div>
  </div>
</div>
<div class=" py-1 mb-0">
  {{$Categorys->links('vendor.pagination.simple-bootstrap-4')}}

</div>
</div>



@endsection
