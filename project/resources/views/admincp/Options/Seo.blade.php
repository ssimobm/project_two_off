@extends('master.main')
@section('title', $tiles." - ".__('settings.seo'))

@section('content')
<div class="container">
  <form  action="{{url('/admincp/options/seo')}}" method="post">
    @csrf
    <div class="row justify-content-center">
   <div class="col-9 form-group">
       <h4 >@lang('settings.seo_tvshows')</h4>
       <input type="text" name='seo_tvshows' class="form-control" aria-describedby="emailHelp" placeholder="Enter @lang('settings.name_site')" @if (isset($Options->where('option_name', 'Seo_TvShows')->first()->option_value))
value="{{$Options->where('option_name', 'Seo_TvShows')->first()->option_value}}"
       @endif >
       {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
   </div>
   <div class="col-9 form-group">
       <h4 >@lang('settings.seo_movies')</h4>
       <input type="text" name='seo_movies' class="form-control" aria-describedby="emailHelp" placeholder="Enter @lang('settings.name_site')" @if (isset($Options->where('option_name', 'Seo_Movies')->first()->option_value))
value="{{$Options->where('option_name', 'Seo_Movies')->first()->option_value}}"
       @endif >
   </div>
   <div class="col-9 form-group">
       <h4 >@lang('settings.seo_seasons')</h4>
       <input type="text" name='seo_seasons' class="form-control" aria-describedby="emailHelp" placeholder="Enter @lang('settings.name_site')" @if (isset($Options->where('option_name', 'Seo_Seasons')->first()->option_value))
 value="{{$Options->where('option_name', 'Seo_Seasons')->first()->option_value}}"
       @endif >
   </div>
   <div class="col-9 form-group">
       <h4 >@lang('settings.seo_episodes')</h4>
       <input type="text" name='seo_episodes' class="form-control" aria-describedby="emailHelp" placeholder="Enter @lang('settings.name_site')" @if (isset($Options->where('option_name', 'Seo_Episodes')->first()->option_value))
value="{{$Options->where('option_name', 'Seo_Episodes')->first()->option_value}}"
       @endif >
   </div>
   <button type="submit" class="col-4 btn btn-primary waves-effect waves-light">@lang('settings.save')</button>
  </div>
                                          </form>



</div>
@endsection
