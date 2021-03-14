@if ($paginator->hasPages())
  <div class="row justify-content-center" id="deletsimo" class="deletsimo">




            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
              <button id='loadcom' class="col-md-4 col-12  loadcom btn btn-outline-blue btn-sm waves-effect waves-light" type="button" >
              Load Comments
               </button>
            @endif
</div>

@endif
