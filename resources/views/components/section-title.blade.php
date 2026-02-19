@props(['title', 'description'])

<div>
    <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
    @if($description)
        <p class="mt-1 text-sm text-gray-500">{{ $description }}</p>
    @endif
</div>
