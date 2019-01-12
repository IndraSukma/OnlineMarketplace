@if ($paginator->hasPages())
  <ul class="pagination pg-blue" role="navigation">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <li class="page-item disabled" aria-disabled="true">
        <a class="page-link">Previous</a>
      </li>
    @else
      <li class="page-item">
        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
      </li>
    @endif

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <li class="page-item">
        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
      </li>
    @else
      <li class="page-item disabled" aria-disabled="true">
        <a class="page-link">Next</a>
      </li>
    @endif
  </ul>
@endif
