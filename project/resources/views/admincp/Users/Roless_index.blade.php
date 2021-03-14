@extends('master.main')

@section('content')
  @canany(['AdmincpSuper','Admincp'], "App\Models\User")

    @php
    date_default_timezone_set("africa/casablanca");
    $dates = date("m/d/Y");
    @endphp


    <div class="container-fluid">
      <!-- start page title -->
      <div class="card">
       <div class="card-body">
             <div class="page-title-box">
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-8 col-12">
                <h3 class="text-md-left text-center" >
                {{__('Settings.name_roles')}}
              </h3>
                 </div>
                <div class="col-lg-8 col-md-8 col-sm-4 col-12">
                <div class="text-md-right  py-2">
                  <a href="{{url('/admincp/options/roles/permissions')}}" type="button" class="btn btn-success  btn-sm mb-1 waves-effect waves-light">
                      <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Permission
                  </a>
                <a href="{{url('/admincp/options/roles/permissions/add')}}" type="button" class="btn btn-danger  btn-sm mb-1 waves-effect waves-light">
                <span class="btn-label"><i class="mdi mdi-close-circle-outline"></i></span>Add
                </a>
                <a href="{{Request::url()}}" class="btn btn-blue btn-sm mb-1">
                <i class="mdi mdi-autorenew"></i>
                </a>
                </div>
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
        <th>idData</th>
        <th>Edit/Delet</th>
    </tr>
    </thead>
    <tbody>
      @foreach ($Roles as $key => $value)
        <tr class="bg-custom">
    <th scope="row">{{$value->id}}</th>
    <td>{{$value->name}}</td>
    <td>{{$value->type }}</td>
    <td>
      <div class="btn-group mb-2">
        @if (auth()->user()->UserMeta->UserRole->type == "role_admin")
  <a type="button" class="btn btn-light" href='{{ url('/admincp/options/roles/delet/') }}/{{$value->id}}'>Delet</a>
        @endif

          <a type="button" class="btn btn-light" href='{{ url('/admincp/options/roles/edit') }}/{{$value->id}}'>edit</a>

                              </div>

    </td>
        </tr>
      @endforeach




    </tbody>
      </table>
                                    </div>
  </div>
</div>
{{-- <div class=" py-1 mb-0">
  {{$data->links('vendor.pagination.simple-bootstrap-4')}}

</div> --}}
</div>
</div>
</div>
@endcanany

@endsection
