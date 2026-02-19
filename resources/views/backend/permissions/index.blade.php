@extends('backend.layouts.app')
@section('content')

    <div class="p-4 sm:ml-64 mt-16 flex flex-col min-h-screen">
        <!-- Page Header -->
        <div class="mb-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center">
                    <i data-lucide="key" class="w-6 h-6 text-primary-600"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Permissions</h1>
                    <p class="text-sm text-gray-500 mt-0.5">Manage system permissions • {{ $stats['total'] }} total permissions</p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div role="alert" class="rounded-xl mb-6 border border-green-100 bg-green-50 p-4 alert-message">
                <div class="flex items-start gap-3">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5"></i>
                    <div class="flex-1">
                        <strong class="block font-medium text-green-800">{{ session('success') }}</strong>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600 transition-colors close-btn">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div role="alert" class="rounded-xl mb-6 border border-red-100 bg-red-50 p-4 alert-message">
                <div class="flex items-start gap-3">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5"></i>
                    <div class="flex-1">
                        <strong class="block font-medium text-red-800">{{ session('error') }}</strong>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600 transition-colors close-btn">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Permissions</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-primary-50 flex items-center justify-center">
                        <i data-lucide="key" class="w-6 h-6 text-primary-500"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Assigned to Roles</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['assigned_to_roles'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center">
                        <i data-lucide="shield" class="w-6 h-6 text-purple-500"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="bg-white rounded-lg border border-gray-200 p-4 mb-6">
            <form method="GET" action="{{ route('admin.permissions.index') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search permissions..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm"
                        >
                    </div>
                </div>
                <button type="submit" class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition text-sm font-medium">
                    Search
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.permissions.index') }}" class="px-4 py-2.5 bg-white text-gray-700 rounded-lg hover:bg-gray-50 border border-gray-300 text-sm font-medium flex items-center justify-center gap-2">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Permissions Table -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">All Permissions</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Assign permissions to roles from the Roles page</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <div class="relative group">
                            <button type="button" id="export-permissions-dropdown-trigger" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">
                                <i data-lucide="download" class="w-4 h-4 mr-2"></i> Export <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                            </button>
                            <div id="export-permissions-dropdown" class="hidden absolute right-0 mt-1 w-48 bg-white rounded-lg border border-gray-200 shadow-lg py-1 z-20">
                                <a href="{{ route('admin.permissions.export.csv', request()->query()) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i data-lucide="file-text" class="w-4 h-4 mr-2 text-gray-500"></i> Export all CSV</a>
                                <a href="{{ route('admin.permissions.export.pdf', request()->query()) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i data-lucide="file" class="w-4 h-4 mr-2 text-gray-500"></i> Export all PDF</a>
                            </div>
                        </div>
                        <button type="button" id="open-create-permission-modal" class="inline-flex items-center px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors font-medium text-sm shadow-sm hover:shadow-md">
                            <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Add Permission
                        </button>
                    </div>
                </div>
                <div id="permissions-bulk-bar" class="hidden mt-3 pt-3 border-t border-gray-200 flex flex-wrap items-center gap-2">
                    <span id="permissions-bulk-count" class="text-sm font-medium text-gray-700">0 selected</span>
                    <a id="permissions-bulk-export-csv" href="#" class="inline-flex items-center px-3 py-1.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Export selected CSV</a>
                    <a id="permissions-bulk-export-pdf" href="#" class="inline-flex items-center px-3 py-1.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Export selected PDF</a>
                    <button type="button" id="permissions-bulk-delete" class="inline-flex items-center px-3 py-1.5 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100">Delete selected</button>
                </div>
            </div>

            @if($permissions->isEmpty())
                <div class="flex flex-col items-center justify-center py-16">
                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                        <i data-lucide="key" class="w-10 h-10 text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">No permissions found</h3>
                    <p class="text-sm text-gray-500 text-center max-w-sm mb-6">
                        Run the RolePermissionSeeder to create default permissions, or add custom ones.
                    </p>
                    <button type="button" id="open-create-permission-modal-empty" class="inline-flex items-center px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors font-medium text-sm">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                        Add Permission
                    </button>
                </div>
            @else
                <form id="permissions-bulk-form" action="{{ route('admin.permissions.bulk-destroy') }}" method="POST" class="hidden">@csrf</form>
                @include('backend.partials.confirm-bulk-delete-modal', [
                    'formId' => 'permissions-bulk-form',
                    'title' => 'Delete Permissions',
                    'messageTemplate' => 'Are you sure you want to delete {count} selected permission(s)? This will remove them from all roles.',
                ])
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="py-3.5 px-5 w-10"><input type="checkbox" id="permissions-select-all" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500" title="Select all"></th>
                                <th class="py-3.5 px-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">#</th>
                                <th class="py-3.5 px-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Permission</th>
                                <th class="py-3.5 px-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Roles</th>
                                <th class="py-3.5 px-5 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider w-[120px]">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                                <tr class="border-b hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-5 w-10"><input type="checkbox" class="permission-row-cb rounded border-gray-300 text-primary-600 focus:ring-primary-500" value="{{ $permission->id }}"></td>
                                    <td class="py-4 px-5 text-sm text-gray-600 font-medium">{{ $permission->id }}</td>
                                    <td class="py-4 px-5">
                                        <span class="font-medium text-gray-900">{{ str_replace('-', ' ', $permission->name) }}</span>
                                        <span class="text-gray-400 text-xs ml-1">({{ $permission->name }})</span>
                                    </td>
                                    <td class="py-4 px-5 text-sm text-gray-600">{{ $permission->roles_count }}</td>
                                    <td class="py-4 px-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <button type="button" class="edit-permission p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors" title="Edit" data-permission-id="{{ $permission->id }}">
                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                            </button>
                                            <button type="button" class="delete-permission p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete" data-permission-id="{{ $permission->id }}" data-permission-name="{{ $permission->name }}">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                            <form id="delete-permission-form-{{ $permission->id }}" action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('backend.partials.pagination', ['paginator' => $permissions, 'showPerPage' => true])
            @endif
        </div>
    </div>

    <!-- Create Permission Modal -->
    <div id="create-permission-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center">
                        <i data-lucide="key-plus" class="w-6 h-6 text-primary-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Add Permission</h3>
                        <p class="text-sm text-gray-500">Create a new permission (e.g. manage-settings)</p>
                    </div>
                </div>
                <button type="button" class="close-create-permission-modal p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form action="{{ route('admin.permissions.store') }}" method="POST" id="create-permission-form">
                @csrf
                <div class="px-6 py-5">
                    <label for="create_permission_name" class="block text-sm font-medium text-gray-700 mb-1">Permission name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="create_permission_name" value="{{ old('name') }}" placeholder="e.g. manage-settings" required
                        class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                    <button type="button" class="close-create-permission-modal px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors font-medium text-sm shadow-sm">
                        <i data-lucide="save" class="w-4 h-4 mr-2 inline"></i>
                        Create Permission
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Permission Modal -->
    <div id="edit-permission-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center">
                        <i data-lucide="key" class="w-6 h-6 text-primary-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Edit Permission</h3>
                        <p class="text-sm text-gray-500">Update permission name</p>
                    </div>
                </div>
                <button type="button" class="close-edit-permission-modal p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form id="edit-permission-form" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="px-6 py-5">
                    <label for="edit_permission_name" class="block text-sm font-medium text-gray-700 mb-1">Permission name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="edit_permission_name" required
                        class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm">
                </div>
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                    <button type="button" class="close-edit-permission-modal px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors font-medium text-sm shadow-sm">
                        <i data-lucide="save" class="w-4 h-4 mr-2 inline"></i>
                        Update Permission
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Permission Confirmation -->
    <div id="delete-permission-popup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg border border-gray-200 p-6 max-w-md w-full">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">Delete Permission</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Are you sure you want to delete <span id="delete-permission-name-display" class="font-medium text-gray-900"></span>? This will remove it from all roles.
                    </p>
                    <div class="mt-6 flex gap-3">
                        <button id="confirm-delete-permission" class="flex-1 px-4 py-2.5 text-sm font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 transition-colors shadow-sm">Yes, Delete</button>
                        <button id="cancel-delete-permission" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
        document.querySelectorAll('.close-btn').forEach(btn => {
            btn.addEventListener('click', function() { this.closest('.alert-message').remove(); });
        });

        const createModal = document.getElementById('create-permission-modal');
        const editModal = document.getElementById('edit-permission-modal');
        const deletePopup = document.getElementById('delete-permission-popup');

        function openCreateModal() {
            createModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            lucide.createIcons();
        }
        function closeCreateModal() {
            createModal.classList.add('hidden');
            document.body.style.overflow = '';
            document.getElementById('create-permission-form').reset();
        }
        document.querySelectorAll('#open-create-permission-modal, #open-create-permission-modal-empty').forEach(btn => {
            if (btn) btn.addEventListener('click', openCreateModal);
        });
        document.querySelectorAll('.close-create-permission-modal').forEach(btn => btn.addEventListener('click', closeCreateModal));
        createModal.addEventListener('click', function(e) { if (e.target === createModal) closeCreateModal(); });

        const editPermissionDataUrl = '{{ route("admin.permissions.data", ["permission" => "__ID__"]) }}';
        const editPermissionUpdateUrl = '{{ route("admin.permissions.update", ["permission" => "__ID__"]) }}';
        function openEditModal(permissionId) {
            fetch(editPermissionDataUrl.replace('__ID__', permissionId), {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            }).then(r => r.json()).then(data => {
                document.getElementById('edit-permission-form').action = editPermissionUpdateUrl.replace('__ID__', data.id);
                document.getElementById('edit_permission_name').value = data.name;
                editModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                lucide.createIcons();
            }).catch(() => alert('Failed to load permission.'));
        }
        function closeEditModal() {
            editModal.classList.add('hidden');
            document.body.style.overflow = '';
        }
        document.querySelectorAll('.edit-permission').forEach(btn => {
            btn.addEventListener('click', function() { openEditModal(this.getAttribute('data-permission-id')); });
        });
        document.querySelectorAll('.close-edit-permission-modal').forEach(btn => btn.addEventListener('click', closeEditModal));
        editModal.addEventListener('click', function(e) { if (e.target === editModal) closeEditModal(); });

        let deletePermissionId = null;
        document.querySelectorAll('.delete-permission').forEach(btn => {
            btn.addEventListener('click', function() {
                deletePermissionId = this.getAttribute('data-permission-id');
                document.getElementById('delete-permission-name-display').textContent = this.getAttribute('data-permission-name');
                deletePopup.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                lucide.createIcons();
            });
        });
        document.getElementById('confirm-delete-permission').addEventListener('click', function() {
            if (deletePermissionId) document.getElementById('delete-permission-form-' + deletePermissionId).submit();
        });
        document.getElementById('cancel-delete-permission').addEventListener('click', function() {
            deletePopup.classList.add('hidden');
            document.body.style.overflow = '';
            deletePermissionId = null;
        });
        deletePopup.addEventListener('click', function(e) {
            if (e.target === deletePopup) {
                deletePopup.classList.add('hidden');
                document.body.style.overflow = '';
                deletePermissionId = null;
            }
        });

        const exportPermsTrigger = document.getElementById('export-permissions-dropdown-trigger');
        const exportPermsDropdown = document.getElementById('export-permissions-dropdown');
        if (exportPermsTrigger && exportPermsDropdown) {
            exportPermsTrigger.addEventListener('click', function(e) { e.stopPropagation(); exportPermsDropdown.classList.toggle('hidden'); });
            document.addEventListener('click', function() { exportPermsDropdown.classList.add('hidden'); });
        }
        function getSelectedPermissionIds() { return Array.from(document.querySelectorAll('.permission-row-cb:checked')).map(cb => cb.value); }
        function updatePermissionsBulkBar() {
            const ids = getSelectedPermissionIds();
            const bar = document.getElementById('permissions-bulk-bar');
            const countEl = document.getElementById('permissions-bulk-count');
            const csvLink = document.getElementById('permissions-bulk-export-csv');
            const pdfLink = document.getElementById('permissions-bulk-export-pdf');
            if (!bar || !countEl) return;
            if (ids.length === 0) { bar.classList.add('hidden'); return; }
            bar.classList.remove('hidden');
            countEl.textContent = ids.length + ' selected';
            const params = new URLSearchParams(window.location.search);
            ids.forEach(id => params.append('ids[]', id));
            csvLink.href = '{{ url("admin/permissions/export/csv") }}?' + params.toString();
            pdfLink.href = '{{ url("admin/permissions/export/pdf") }}?' + params.toString();
        }
        document.getElementById('permissions-select-all')?.addEventListener('change', function() {
            document.querySelectorAll('.permission-row-cb').forEach(cb => { cb.checked = this.checked; });
            updatePermissionsBulkBar();
        });
        document.querySelectorAll('.permission-row-cb').forEach(cb => cb.addEventListener('change', updatePermissionsBulkBar));
        document.getElementById('permissions-bulk-delete')?.addEventListener('click', function() {
            const ids = getSelectedPermissionIds();
            if (ids.length === 0) return;
            const form = document.getElementById('permissions-bulk-form');
            form.querySelectorAll('input[name="ids[]"]').forEach(el => el.remove());
            ids.forEach(id => { const i = document.createElement('input'); i.type = 'hidden'; i.name = 'ids[]'; i.value = id; form.appendChild(i); });
            var modal = document.getElementById('bulk-delete-confirm-modal');
            var msg = (modal.getAttribute('data-message-template') || '').replace('{count}', ids.length);
            document.getElementById('bulk-delete-message').textContent = msg;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });
    });
</script>
@endsection
