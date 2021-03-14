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
            {{__('Settings.name_users')}}
          </h3>
             </div>
            <div class="col-lg-8 col-md-8 col-sm-4 col-12">
            <div class="text-md-right  py-2">
              <a href="{{url('/admincp/options/users')}}" type="button" class="btn btn-blue  btn-sm mb-1 waves-effect waves-light">
                  <span class="btn-label"><i class="fas fa-users"></i></span>Users
              </a>
              <a href="{{url('/admincp/options/users/add')}}" type="button" class="btn btn-success  btn-sm mb-1 waves-effect waves-light">
                  <span class="btn-label"><i class="fas fa-user-plus"></i></span>Add
              </a>
            <a href="{{url('/admincp/options/users/trached')}}" type="button" class="btn btn-danger  btn-sm mb-1 waves-effect waves-light">
            <span class="btn-label"><i class="fas fa-trash-alt"></i></span>Trached
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
       <th>Emails</th>
       <th>@if (auth()->user()->UserMeta->UserRole->type == "role_admin")Delet @endif  / Edit</th>
       </tr>
       </thead>
       <tbody>
         @foreach ($users as $key => $value)
       @if ($value->id === 1 or $value->id === auth()->user()->id)@else

       <tr class="bg-custom">
       <th scope="row">{{$value->id}}</th>
       <td>{{$value->name}}</td>
       <td>{{$value->email }}</td>
       <td>
         <div class="btn-group mb-2">
       @if (auth()->user()->UserMeta->UserRole->type == "role_admin")
  <a type="button" class="remove btn btn-light" id='{{$value->id}}'  data-toggle="modal" data-target="#remove">Delet</a>
       @endif

       <a type="button" class="btn btn-light" href='{{ url('/admincp/options/users/edit') }}/{{$value->id}}'>edit</a>

       </div>

       </td>
       </tr>
       @endif
         @endforeach

<div class="show_confirm"></div>


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
<!-- Plugins js-->

<script type="text/javascript">
function TopModalSite(name_type,type_id,id,link,title,text,id_div) {
  if (type_id === name_type) {

    $(id_div).html('<div id="' + type_id + '" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"> <div class="modal-dialog modal-top"> <div class="modal-content"> <div class="modal-header"> <h4 class="modal-title" id="topModalLabel">'+title+'</h4> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> </div> <div class="modal-body"> '+text+' </div> <div class="modal-footer"> <button type="button" class="btn btn-light" data-dismiss="modal">Close</button> '+link+' </div> </div><!-- /.modal-content --> </div><!-- /.modal-dialog --> </div>');

  }};
$(".remove").click( function(){
  id = $(this).attr("id");
  name = $(this).attr("data-target").replace("#", "");
  title = 'Remove Confirm';
  text = '';
  color = 'btn-danger';
  id_div = ".show_confirm";
  link = '<a href="{{ url('/admincp/options/users/delet/') }}/'+id+'" type="button" class="btn '+color+'">Confirm '+ name +'</a>';
 TopModalSite('remove',name,id,link,title,text,id_div);


 });
</script>
@endcanany

@endsection
