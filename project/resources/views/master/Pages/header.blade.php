@php
$SeoAll = new \App\MyClass\SimoPhp ;
$Seo = $SeoAll->seo_meta() ;
@endphp
<meta charset="utf-8" />
<title>@yield('title',$Seo->title)</title>
<meta name="description" content="@yield('meta',$Seo->meta)">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
<meta content="Coderthemes" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- App favicon -->
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
		<!-- App css -->


     <!-- Fonts -->
     <!-- Styles -->
		 <link href="{{asset('css/bootstrap-dark.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
			<link href="{{asset('css/app-dark-rtl.css')}} " rel="stylesheet" type="text/css" id="app-default-stylesheet" />					<!-- icons -->
					<link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
          <link href="{{ asset('assets/libs/selectize/selectize.min.css') }}" rel="stylesheet" type="text/css" />
          <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('assets/libs/multiselect/multiselect.min.css') }}" rel="stylesheet" type="text/css" />
            <script src="{{asset('js/vendor.js')}}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
