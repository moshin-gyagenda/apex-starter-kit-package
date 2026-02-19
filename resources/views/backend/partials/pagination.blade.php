@php
    $perPageOptions = [10, 15, 25, 50, 100];
    $currentPerPage = request('per_page', 15);
    $currentUrl = request()->url();
    $query = request()->except(['per_page', 'page']);
@endphp
@if(isset($paginator))
    <div class="px-5 py-4 border-t border-gray-200 bg-gray-50">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-3">
                <span class="text-sm text-gray-700">
                    Showing <span class="font-medium">{{ $paginator->firstItem() ?? 0 }}</span> to <span class="font-medium">{{ $paginator->lastItem() ?? 0 }}</span> of <span class="font-medium">{{ $paginator->total() }}</span> results
                </span>
                @if(isset($showPerPage) && $showPerPage)
                    <form method="GET" action="{{ $currentUrl }}" class="flex items-center gap-2" id="per-page-form">
                        @foreach($query as $key => $value)
                            @if(is_array($value))
                                @foreach($value as $v)
                                    <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        <label for="per_page" class="text-sm text-gray-600">Per page</label>
                        <select name="per_page" id="per_page" class="py-1.5 px-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 bg-white" onchange="document.getElementById('per-page-form').submit();">
                            @foreach($perPageOptions as $opt)
                                <option value="{{ $opt }}" {{ (int) $currentPerPage === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </form>
                @endif
            </div>
            @if($paginator->hasPages())
                <div class="flex items-center">
                    {{ $paginator->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endif
