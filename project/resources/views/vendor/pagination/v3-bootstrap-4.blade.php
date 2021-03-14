
@if ($paginator->hasPages())
  @if ($paginator->hasMorePages())
@endif @endif
<div class="submito">
<script  type="text/javascript">

var page = "{{explode("page=",$paginator->nextPageUrl())[1]}}";


</script>
</div>
