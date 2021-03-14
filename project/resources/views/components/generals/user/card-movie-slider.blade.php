<div class="item px-1">
    <a href='{{ url('movies') }}/{{ $data->slug }}' class="card filmoq-box getlink">
        {{-- <div class="bg-dark text-white">
{{Str::limit($data->Name_tv, 20, '...')}}
</div> --}}
<img src="{{ url('storage/images') }}/{{$data->tvdata->where('simokey', 'postimg')->first()->simovalue}}
" class="img-tv-movies mx-auto d-block" alt="...">
<div class="filmoq-two-two filmoq-two-two-blue"><span>Primary</span></div>

<div class="card-body">
    <h5 class="card-title">

        {{-- Episode {{$data->Ep_Nm}} --}}
        {{Str::limit($data->title, 16, '...')}}
    </h5>

</div>
</a>
</div>
