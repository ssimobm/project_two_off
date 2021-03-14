@extends('master.main')

@section('content')
<!-- Plugins css -->
<link href="{{ asset('assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('js/dropzone.min.js') }}" ></script>
    <script src="{{ asset('js/dropify.min.js') }}" ></script>
<style>
.selectize-control.multi .selectize-input.has-items {

    height: auto;
}
.tox.tox-tinymce {
    height: 300px!important;
}.card {
    margin-bottom: 2px;
    box-shadow: 0 0.75rem 6rem rgba(56,65,74,.03);
}
</style>
<div class="container-fluid">
@yield('Post_id')
</div>
<!-- Plugins js -->
<script src="{{ asset('assets/js/tinymce.min.js') }}" referrerpolicy="origin"></script>

<script>
tinymce.init({
   selector: 'textarea',
   height: 500,
   menubar: false,
   directionality :"rtl",
   toolbar: 'undo redo | formatselect | ' +
   'bold italic backcolor | alignleft aligncenter ' +
   'alignright alignjustify | bullist numlist outdent indent | ' +
   'removeformat | help',
   content_css: '//www.tiny.cloud/css/codepen.min.css'
 });
   </script>

    <script src="{{ asset('assets/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-validation.init.js') }}"></script>
  <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}" ></script>
   <script src="{{ asset('assets/libs/select2/select2.min.js') }}" ></script>
   <script src="{{ asset('assets/libs/multiselect/multiselect.min.js') }}" ></script>
   <link href="{{ asset('assets/libs/dropify/dropify.min.js') }}" rel="stylesheet" type="text/css" />

   <script src="{{ asset('js/form-fileuploads.init.js') }}" ></script>

@endsection
