@props(['submit'])

<div {{ $attributes->merge(['class' => 'mb-6']) }}>
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <!-- Section Header -->
        <div class="px-4 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
            <p class="mt-1 text-sm text-gray-500">{{ $description }}</p>
        </div>

        <!-- Form Content -->
        <form wire:submit="{{ $submit }}">
            <div class="px-4 py-5 sm:p-6">
                <div class="space-y-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="px-4 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end gap-3">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
