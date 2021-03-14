<div id="{{$typeserver}}" class="collapse show py-1 mb-0">
  @php
  $data_base =$data->where('type', $type);
  $datas =$data_base->where('server_type', $typeserver)->all();

  @endphp



  @if (count($datas) > 0)
  @foreach ($datas as $key => $value)

  <div id="input_{{$typeserver}}"><div class="row mx-auto">
  <input type="text" name="{{$typeserver}}[{{$typeserver.'-'.$value->id}}][link]" class="col-md-6 col-12 form-control" placeholder="Enter link" autocomplete="off" value="{{ $value->link }}" required="" data-parsley-minlength="2">
  <input type="text" name="{{$typeserver}}[{{$typeserver.'-'.$value->id}}][name]" class="col-md-3 col-4 form-control" placeholder="Enter title" autocomplete="off" value="{{ $value->name }}"  required="" data-parsley-minlength="3">
  <input type="text" name="{{$typeserver}}[{{$typeserver.'-'.$value->id}}][quality]" class="col-md-2 col-4 form-control" placeholder="quality" autocomplete="off" value="{{ $value->quality }}" required="" data-parsley-minlength="3">
  <button id="removeRow_{{$typeserver}}" server_id="{{$value->id}}" type="button" class="col-md-1 col-4 btn btn-danger">Delet</button>
  </div></div>



  @endforeach

  @else

  <div id="input_{{$typeserver}}"><div class="row mx-auto">
  <input type="text" name="{{$typeserver}}[{{$typeserver}}-1][link]" id="validationCustom02" class="col-md-6 col-12 form-control m-input" placeholder="Enter title" autocomplete="off"  required="" data-parsley-minlength="3">
  <input type="text" name="{{$typeserver}}[{{$typeserver}}-1][name]" id="validationCustom02" class="col-md-3 col-4 form-control m-input" placeholder="Enter title" autocomplete="off"  required="" data-parsley-minlength="3">
  <input type="text" name="{{$typeserver}}[{{$typeserver}}-1][quality]" id="validationCustom02" class="col-md-2 col-4 form-control m-input" placeholder="quality" autocomplete="off" required="" data-parsley-minlength="3">
  <button id="removeRow_{{$typeserver}}"  type="button" class="col-md-1 col-4 btn btn-danger">Delet</button>
  </div></div>

  @endif
  <div id="{{$typeserver}}_data"></div>
<div class="py-1 mb-0">
   <button id="{{$typeserver}}_add" type="button" class="btn btn-info">Add Row</button>
</div>

 </div>

 <script type="text/javascript">
 simo = '{{count($datas) > 0 ? count($datas)+1 :"1"}}';
 $("#{{$typeserver}}_add").click(function () {
     simo++ ;
     var html = '';
     html += '<div id="input_{{$typeserver}}">';
     html += '<div class="row mx-auto">';
     html += '<input type="text" name="{{$typeserver}}[{{$typeserver}}-'+ simo +'][link]" id="validationCustom02" class="col-md-6 col-12 form-control m-input" placeholder="Enter title" autocomplete="off"  required="" data-parsley-minlength="3">';
     html += '<input type="text" name="{{$typeserver}}[{{$typeserver}}-'+ simo +'][name]" id="validationCustom02" class="col-md-3 col-4 form-control m-input" placeholder="Enter title" autocomplete="off"  required="" data-parsley-minlength="3">';
     html += '<input type="text" name="{{$typeserver}}[{{$typeserver}}-'+ simo +'][quality]" id="validationCustom02" class="col-md-2 col-4 form-control m-input" placeholder="quality" autocomplete="off" required="" data-parsley-minlength="3">';
     html += '<button id="removeRow_{{$typeserver}}" type="button" class="col-md-1 col-4 btn btn-danger">Delet</button>';
     html += '</div>';
     $('#{{$typeserver}}_data').append(html);
 });

 // remove row
 $(document).on('click', '#removeRow_{{$typeserver}}', function () {
     var id = $(this).attr("server_id");
    if (id) {
      $.ajax({
      url: '{{url('episodes/server/delet')}}/'+id,
      method:"POST",
      dataType: 'html',
      data:{id:id},
      success: function(data, status){
      if (status == "success"){

      $('#removeRow_{{$typeserver}}').closest('#input_{{$typeserver}}').remove();
     }
     }
      });
    }else {
      $(this).closest('#input_{{$typeserver}}').remove();
    }

 });

   </script>
