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

                                              @if (isset($data[0]))
          <tr>
              <th>id</th>
              <th>Names</th>
              <th>Seasons</th>
              <th>Data</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($data as $key => $value)
            <tr class="bg-custom">
          <th scope="row">{{$value->id}}</th>
          <td>{{$value->name_tvshow}}</td>
          <td>{{$value->name_season}}</td>
          <td>
            <div class="btn-group mb-2">
          <a type="button" class="btn btn-light" href='{{ url('/admincp/seasons/restore/') }}/{{$value->id}}'>restore</a>
          <a type="button" class="btn btn-light" href='{{ url('/admincp/seasons/destroy/') }}/{{$value->id}}'>destroy</a>

                  </div>

          </td>
            </tr>
          @endforeach
          </tbody>
                                              @else
                                              </thead>

                                              <tbody>
                        <td><div class="table-dark text-center">
                          ide data
                        </div></td>


@endif



                                            </tbody>
                                        </table>
                                    </div>
  </div>
</div>
<div class=" py-1 mb-0">
  {{$data->links('vendor.pagination.simple-bootstrap-4')}}

</div>
</div>



@endsection
