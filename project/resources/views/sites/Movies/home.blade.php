@extends('master.main')
@php

@endphp
@section('content')
<div class="px-4 py-8">
<div class="row justify-content-center"  id="results">
@foreach ($data as $key => $value)
@php
$db = $data1->where('tv_id', $data[$key]->id) ;
$db1 = json_decode($db->where('simokey', 'tvshow_tmdb')->first()) ;
$postimg = json_decode($db->where('simokey', 'tvshow_postimg')->first()) ;



@endphp


  @if ($db1->tv_id == $data[$key]->id)

                   <div class="col-lg-2 col-md-3 col-sm-3 col-6">
                     <div class="card">
                        <img class="card-img-top img-thumbnail" src="{{ asset('storage/'.$postimg->simovalue) }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">
                          {{Str::limit($data[$key]->title, 20, '...')}}
                            </h5>

                      </div>


</div>
</div>

  @endif
@endforeach

<div class="simoid" id="simoid">
</div>



</div>
</div>

  <style>
     .wrapper > ul#results li {
       margin-bottom: 2px;
       background: #e2e2e2;
       padding: 20px;
       width: 97%;
       list-style: none;
     }
     .ajax-loading{
       text-align: center;
     }
  </style>

  {{$data->links('vendor.pagination.bootstrap-4')}}

  <div class="wrapper">
     <div class="ajax-loading" style="display:none"><button class="btn btn-outline-blue btn-sm waves-effect waves-light" type="button" disabled="">
                                                        <span class="spinner-grow spinner-grow-sm mr-1" role="status" aria-hidden="true"></span>
                                                        Loading...
                                                    </button></div>
  </div>
  <script>

  var page = 5; //track user scroll as page number, right now page number is 1
  load_more(page); //initial content load
  $(window).scroll(function() { //detect page scroll

     if($(window).scrollTop() + 13 >= $(document).height()- $(window).height() ) { //if user scrolled from top to bottom of the
      $( "#submito" ).remove();
page++;
           load_more(page); //load content

   }else {

   }

   });

      function load_more(page){
          $.ajax({
             url: 'http://192.168.1.121/site2021/public/tvshows/loadajax?page=' + page,
             type: "get",
             datatype: "html",
             beforeSend: function()
             {
                $('.ajax-loading').show();
              }
          })
          .done(function(data)
          {
              if(data.length == 0){
              console.log(data.length);
              //notify user if nothing to load
              $('.ajax-loading').html("No more records!");
              return;
            }
            $('.ajax-loading').hide(); //hide loading animation once data is received
              $( "#submito" ).remove();
            $("#results").append(data); //append data into #results element
             //console.log('data.length');
             $('.ajax-loading').hide();
         })

      }
  </script>


@endsection
