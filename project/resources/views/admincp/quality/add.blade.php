@extends('master.add-post')

  @section('Post_id')

        <div class="container">
    <div class="col-12"> <div class="page-title-box"> <div class="page-title-right">
      <ol class="breadcrumb m-0"><li class="breadcrumb-item">
      Filmoq</li> <li class="breadcrumb-item"><a href="javascript: void(0);">Season</a></li>
       <li class="breadcrumb-item active"><a href="javascript: void(0);">Add Season</a></li>
     </ol> </div>
      <h4 class="page-title" >ADD Season</h4> </div> </div>

      <form action="{{ url('/admincp/quality/add') }}" enctype="multipart/form-data" method="post">


    @csrf


     <input type="text" id="simpleinput" name="addTiltle" class="form-control" placeholder="ADD Title">

    <div class="py-1 mb-1">
    <textarea name="editor"></textarea>
    </div>

    <button type="submit" name="Submit" class="btn btn-block btn--md btn-pink waves-effect waves-light">Save</button>
</form>
</div>

@endsection
