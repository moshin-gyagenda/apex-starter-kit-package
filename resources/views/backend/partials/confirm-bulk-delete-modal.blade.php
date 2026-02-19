{{-- Reusable confirmation modal for bulk delete. Include with $formId, $title, $messageTemplate (use {count}). JS sets #bulk-delete-message and shows modal; Confirm submits the form. --}}
<div id="bulk-delete-confirm-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4" data-form-id="{{ $formId ?? '' }}" data-message-template="{{ $messageTemplate ?? 'Delete {count} selected item(s)?' }}">
    <div class="bg-white rounded-xl border border-gray-200 shadow-xl max-w-md w-full p-6" onclick="event.stopPropagation()">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-lg font-semibold text-gray-900">{{ $title ?? 'Confirm Delete' }}</h3>
                <p id="bulk-delete-message" class="mt-2 text-sm text-gray-600"></p>
                <div class="mt-6 flex gap-3">
                    <button type="button" id="bulk-delete-confirm-cancel" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="button" id="bulk-delete-confirm-submit" class="flex-1 px-4 py-2.5 text-sm font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 transition-colors">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
(function() {
    var modal = document.getElementById('bulk-delete-confirm-modal');
    if (!modal) return;
    modal.addEventListener('click', function(e) { if (e.target === modal) { modal.classList.add('hidden'); document.body.style.overflow = ''; } });
    document.getElementById('bulk-delete-confirm-cancel')?.addEventListener('click', function() { modal.classList.add('hidden'); document.body.style.overflow = ''; });
    document.getElementById('bulk-delete-confirm-submit')?.addEventListener('click', function() {
        var fid = modal.getAttribute('data-form-id');
        if (fid) document.getElementById(fid)?.submit();
    });
})();
</script>
