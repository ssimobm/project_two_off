@extends('master.main')
{{-- @section('title', $tiles." - ".__('settings.seo')) --}}

@section('content')
  @canany(['AdmincpSuper','Admincp'], "App\Models\User")

<div class="container">
  <form  action="{{url('/admincp/options/roles/permissions/edit')}}/{{$ids}}" method="post">
    @csrf
    <div class="row justify-content-center">
    <table class="col-auto table">
      <thead>
        <tr>
          <th scope="col">Roles</th>
          <th scope="col">Values</th>
        </tr>
      </thead>
      <tbody>

          @foreach ($Roles as $key => $value)
            <tr>
            <th scope="row"><h6 class="header-title">{{$key}}</h6></th>
            <td> {{-- start col auto --}}

              <div class="radio radio-success form-check-inline">
              <input type="radio"  value="yes" name="Copy[{{$key}}]"  @if ($value == 'yes') checked @endif>
              <label> Yes </label>
              </div>
              <div class="radio radio-pink form-check-inline">
              <input type="radio" value="no" name="Copy[{{$key}}]" @if ($value == 'no') checked @endif>
              <label> No </label>
              </div>
             {{-- end col auto --}}</td>
          </tr>
          @endforeach



      </tbody>
    </table>
 </div>

   <div class="row justify-content-center">
   <button type="submit" class="col-4 btn btn-primary waves-effect waves-light">@lang('settings.save')</button>
 </div>
 </div>
                                          </form>



</div>
@endcanany
@endsection
