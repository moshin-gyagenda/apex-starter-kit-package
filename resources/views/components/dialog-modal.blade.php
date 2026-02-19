@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-5 border-b border-gray-200 bg-gray-50">
        <div class="text-lg font-semibold text-gray-900">
            {{ $title }}
        </div>
    </div>

    <div class="px-6 py-5">
        <div class="text-sm text-gray-600">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end gap-3 px-6 py-4 bg-gray-50 border-t border-gray-200">
        {{ $footer }}
    </div>
</x-modal>
