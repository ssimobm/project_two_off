@extends('master.main')

@php

@endphp
@section('content')

<div class="container-fluid">
<div class="row">
  <div class="col-12">
    <div class="table-responsive">
        <table class="table table-dark text-white mb-0">
            <thead class="bg-primary">
            <tr>
                <th>id</th>
                <th>Names</th>
                <th>idData</th>
                <th>Edit/Delet</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($data as $key => $value)
                <tr class="bg-custom">
                    <th scope="row">{{$value->id}}</th>
                    <td>{{$value->title}}</td>
                    <td>{{$value->tmdb_id }}</td>
                    <td>
                      <div class="btn-group mb-2">
                        <a type="button" class="btn btn-light" href='{{ url('/admincp/data/seasonss/') }}/{{$value->id}}/'>Add Episode</a>


  </div>

                    </td>
                </tr>
              @endforeach




            </tbody>
        </table>
    </div>
  </div>
</div>
<div class="row justify-content-center py-2">
    {{$data->links('vendor.pagination.bootstrap-40')}}


</div>
</div>



@endsection
