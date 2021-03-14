@extends('master.main')
@section('title', $tiles." - ".__('settings.setting'))

@section('content')
<div class="container">
  <form  action="{{url('/admincp/options/settings')}}" method="post">
    @csrf
    <div class="row justify-content-center">
   <div class="col-9 form-group">
       <h4 >@lang('settings.name_site')</h4>
       <input type="text" name='site_name' class="form-control" aria-describedby="emailHelp" placeholder="Enter @lang('settings.name_site')" @if (isset($Options->where('option_name', 'Setting_NameSite')->first()->option_value))
value="{{$Options->where('option_name', 'Setting_NameSite')->first()->option_value}}"
       @endif >
       {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
   </div>
   <div class="col-9 form-group">
       <h4 >@lang('settings.description_site')</h4>
       <textarea type="text" name='site_desc' class="form-control"> @if (isset($Options->where('option_name', 'Setting_DescSite')->first()->option_value))
{{$Options->where('option_name', 'Setting_DescSite')->first()->option_value}}
       @endif </textarea>
   </div>

   <div class="col-9 form-group">
       <h4 >@lang('settings.site_online')</h4>
       <div class="radio radio-success form-check-inline py-2">
              <input type="radio" value="True" name="site_check"
              @if (isset($Options->where('option_name', 'Setting_SiteActive')->first()->option_value) and $Options->where('option_name', 'Setting_SiteActive')->first()->option_value ==='check_True')
              checked=""
              @endif >
              <label> Yes </label>
              </div>
      <div class="radio radio-pink form-check-inline">
             <input type="radio" value="False" name="site_check"
             @if (isset($Options->where('option_name', 'Setting_SiteActive')->first()->option_value) and $Options->where('option_name', 'Setting_SiteActive')->first()->option_value ==='check_False')
             checked=""
             @endif >
             <label> No </label>
             </div>
   </div>

   <div class="col-9 form-group">
       <h4 >@lang('settings.key_site')</h4>
       <textarea type="text" name='site_key' class="form-control">@if (isset($Options->where('option_name', 'Setting_SiteKey')->first()->option_value)){{App\MyClass\MyFunction::ary_filter_decjson($Options->where('option_name', 'Setting_SiteKey')->first()->option_value)}}@endif </textarea>
   </div>
   <button type="submit" class="col-4 btn btn-primary waves-effect waves-light">@lang('settings.save')</button>
  </div>
                                          </form>



</div>
@endsection
