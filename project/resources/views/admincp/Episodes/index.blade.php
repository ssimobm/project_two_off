@extends('master.main')

@php

@endphp
@section('content')

  <div class="container-md mx-md-auto">
              <div class="d-flex justify-content-between">
                <div class="d-flex justify-content-start">
                <h3 class="text-left">
                {{__("Episodes")}}
              </h3>
                 </div>
                <div class="d-flex justify-content-end">
                <div class="text-right  py-2">
                  <a href="{{url("/admincp/episodes/Add")}}" type="button" class="btn btn-success  btn-sm mb-1 waves-effect waves-light">
                      <span class="btn-label"><i class="fas fa-user-plus"></i></span>{{__("Add")}}
                  </a>
                <a href="{{url("/admincp/episodes")}}" class="btn btn-blue btn-sm mb-1 d-sm-inline-block d-none">
                <i class="mdi mdi-autorenew"></i>
                </a>
                </div>
                </div>
                </div>
<div class="row">
  <div class="col-12">
    <div class="table-responsive">
                                        <table class="table table-dark text-white mb-0">
                                            <thead class="bg-primary">
                                            <tr>
                                                <th>id</th>
                                                <th>Names</th>
                                                <th>Seasons</th>
                                                <th>Episodes</th>
                                                <th>Edit/Delet</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                              @foreach ($data as $key => $value)
                                                <tr class="bg-custom">
                                                    <th scope="row">{{$value->id}}</th>
                                                    <td>{{$value->name_tvshow}}</td>
                                                    <td>{{$value->name_season}}</td>
                                                    <td>{{$value->name_episode}}</td>
                                                    <td>
                                                      <div class="btn-group mb-2">

     @canany(['AdmincpSuper','Admincp','Delet'], "App\Models\User")
     <a type="button" class="btn btn-light" href='{{ url('/admincp/episodes/delet/') }}/{{$value->id}}'>Delet</a>
     @endcanany

     @canany(['AdmincpSuper','Admincp','Edit'], "App\Models\User")
     <a type="button" class="btn btn-light" href='{{ url('/admincp/episodes/edit/') }}/{{$value->id}}'>edit</a>
     @endcanany
     @canany(['AdmincpSuper','Admincp','Views'], "App\Models\User")
     <a type="button" class="btn btn-light" href='{{ url('/episodes/') }}/{{$value->slug}}'>view</a>
     @endcanany
<a type="button" class="btn btn-light" href='{{ url('/admincp/autofixes/episodes') }}/{{$value->sea_id}}'>autoFixe</a>


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
