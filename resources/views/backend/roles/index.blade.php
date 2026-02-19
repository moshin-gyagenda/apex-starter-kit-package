@extends('backend.layouts.app')
@section('content')

    <div class="p-4 sm:ml-64 mt-16 flex flex-col min-h-screen">
        <!-- Page Header -->
        <div class="mb-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center">
                    <i data-lucide="shield" class="w-6 h-6 text-primary-600"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Roles</h1>
                    <p class="text-sm text-gray-500 mt-0.5">Manage roles and their permissions • {{ $stats['total'] }} total roles</p>
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Roles</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-primary-50 flex items-center justify-center">
                        <i data-lucide="shield" class="w-6 h-6 text-primary-500"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">With Permissions</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['with_permissions'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center">
                        <i data-lucide="key" class="w-6 h-6 text-purple-500"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">With Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['with_users'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center">
                        <i data-lucide="users" class="w-6 h-6 text-green-500"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="bg-white rounded-lg border border-gray-200 p-4 mb-6">
            <form method="GET" action="{{ route('admin.roles.index') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search roles..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm"
                        >
                    </div>
                </div>
                <button type="submit" class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition text-sm font-medium">
                    Search
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.roles.index') }}" class="px-4 py-2.5 bg-white text-gray-700 rounded-lg hover:bg-gray-50 border border-gray-300 text-sm font-medium flex items-center justify-center gap-2">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Roles Table -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">All Roles</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Assign permissions to roles</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <div class="relative group">
                            <button type="button" id="export-roles-dropdown-trigger" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">
                                <i data-lucide="download" class="w-4 h-4 mr-2"></i> Export <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                            </button>
                            <div id="export-roles-dropdown" class="hidden absolute right-0 mt-1 w-48 bg-white rounded-lg border border-gray-200 shadow-lg py-1 z-20">
                                <a href="{{ route('admin.roles.export.csv', request()->query()) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i data-lucide="file-text" class="w-4 h-4 mr-2 text-gray-500"></i> Export all CSV</a>
                                <a href="{{ route('admin.roles.export.pdf', request()->query()) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i data-lucide="file" class="w-4 h-4 mr-2 text-gray-500"></i> Export all PDF</a>
                            </div>
                        </div>
                        <button type="button" id="open-create-role-modal" class="inline-flex items-center px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors font-medium text-sm shadow-sm hover:shadow-md">
                            <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Add Role
                        </button>
                    </div>
                </div>
                <div id="roles-bulk-bar" class="hidden mt-3 pt-3 border-t border-gray-200 flex flex-wrap items-center gap-2">
                    <span id="roles-bulk-count" class="text-sm font-medium text-gray-700">0 selected</span>
                    <a id="roles-bulk-export-csv" href="#" class="inline-flex items-center px-3 py-1.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Export selected CSV</a>
                    <a id="roles-bulk-export-pdf" href="#" class="inline-flex items-center px-3 py-1.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Export selected PDF</a>
                    <button type="button" id="roles-bulk-delete" class="inline-flex items-center px-3 py-1.5 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100">Delete selected</button>
                </div>
            </div>

            @if($roles->isEmpty())
                <div class="flex flex-col items-center justify-center py-16">
                    <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                        <i data-lucide="shield" class="w-10 h-10 text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">No roles found</h3>
                    <p class="text-sm text-gray-500 text-center max-w-sm mb-6">
                        Create roles and assign permissions to control access.
                    </p>
                    <button type="button" id="open-create-role-modal-empty" class="inline-flex items-center px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors font-medium text-sm">
                        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                        Add Your First Role
                    </button>
                </div>
            @else
                <form id="roles-bulk-form" action="{{ route('admin.roles.bulk-destroy') }}" method="POST" class="hidden">@csrf</form>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50">
                                <th class="py-3.5 px-5 w-10"><input type="checkbox" id="roles-select-all" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500" title="Select all"></th>
                                <th class="py-3.5 px-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">#</th>
                                <th class="py-3.5 px-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Role</th>
                                <th class="py-3.5 px-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Permissions</th>
                                <th class="py-3.5 px-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Users</th>
                                <th class="py-3.5 px-5 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider w-[120px]">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                @php $usersCount = $usersCounts[$role->id] ?? 0; @endphp
                                <tr class="border-b hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-5 w-10">
                                        @if($usersCount === 0)
                                            <input type="checkbox" class="role-row-cb rounded border-gray-300 text-primary-600 focus:ring-primary-500" value="{{ $role->id }}">
                                        @else
                                            <span class="text-gray-300">—</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-5 text-sm text-gray-600 font-medium">{{ $role->id }}</td>
                                    <td class="py-4 px-5">
                                        <span class="font-semibold text-gray-900">{{ ucfirst(str_replace('-', ' ', $role->name)) }}</span>
                                    </td>
                                    <td class="py-4 px-5 text-sm text-gray-600">{{ $role->permissions_count }}</td>
                                    <td class="py-4 px-5 text-sm text-gray-600">{{ $usersCount }}</td>
                                    <td class="py-4 px-5">
                                        <div class="flex items-center justify-center gap-2">
                                            <button type="button" class="edit-role p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors" title="Edit" data-role-id="{{ $role->id }}">
                                                <i data-lucide="edit" class="w-4 h-4"></i>
                                            </button>
                                            <button type="button" class="delete-role p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete" data-role-id="{{ $role->id }}" data-role-name="{{ $role->name }}" data-users-count="{{ $usersCount }}">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                            <form id="delete-role-form-{{ $role->id }}" action="{{ route('admin.roles.destroy', $role) }}" method="POST" class="hidden">
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
                @include('backend.partials.pagination', ['paginator' => $roles, 'showPerPage' => true])
            @endif
        </div>
    </div>

    <!-- Create Role Modal -->
    <div id="create-role-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center">
                        <i data-lucide="shield-plus" class="w-6 h-6 text-primary-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Add New Role</h3>
                        <p class="text-sm text-gray-500">Create a role and assign permissions</p>
                    </div>
                </div>
                <button type="button" class="close-create-role-modal p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form action="{{ route('admin.roles.store') }}" method="POST" id="create-role-form">
                @csrf
                <div class="flex-1 overflow-y-auto px-6 py-5">
                    <div class="space-y-4">
                        <div>
                            <label for="create_role_name" class="block text-sm font-medium text-gray-700 mb-1">Role name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="create_role_name" value="{{ old('name') }}" placeholder="e.g. editor, moderator" required
                                class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <i data-lucide="key" class="w-4 h-4 mr-2 text-primary-500"></i>
                                Permissions
                            </h4>
                            <div class="border border-gray-200 rounded-lg p-4 max-h-60 overflow-y-auto space-y-4">
                                @foreach($permissions as $group => $items)
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase mb-2">{{ $group }}</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($items as $permission)
                                                <label class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer">
                                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}
                                                        class="rounded border-gray-300 text-primary-600 focus:ring-primary-500 create-role-permission-cb">
                                                    <span class="ml-2 text-sm text-gray-700">{{ str_replace('-', ' ', $permission->name) }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                    <button type="button" class="close-create-role-modal px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors font-medium text-sm shadow-sm">
                        <i data-lucide="save" class="w-4 h-4 mr-2 inline"></i>
                        Create Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div id="edit-role-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center">
                        <i data-lucide="shield" class="w-6 h-6 text-primary-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Edit Role</h3>
                        <p class="text-sm text-gray-500">Update role name and permissions</p>
                    </div>
                </div>
                <button type="button" class="close-edit-role-modal p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            <form id="edit-role-form" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="flex-1 overflow-y-auto px-6 py-5">
                    <div class="space-y-4">
                        <div>
                            <label for="edit_role_name" class="block text-sm font-medium text-gray-700 mb-1">Role name <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="edit_role_name" required
                                class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm">
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                                <i data-lucide="key" class="w-4 h-4 mr-2 text-primary-500"></i>
                                Permissions
                            </h4>
                            <div class="border border-gray-200 rounded-lg p-4 max-h-60 overflow-y-auto space-y-4" id="edit-role-permissions-container">
                                @foreach($permissions as $group => $items)
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase mb-2">{{ $group }}</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($items as $permission)
                                                <label class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer">
                                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500 edit-role-permission-cb">
                                                    <span class="ml-2 text-sm text-gray-700">{{ str_replace('-', ' ', $permission->name) }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                    <button type="button" class="close-edit-role-modal px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors font-medium text-sm shadow-sm">
                        <i data-lucide="save" class="w-4 h-4 mr-2 inline"></i>
                        Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Role Confirmation -->
    <div id="delete-role-popup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg border border-gray-200 p-6 max-w-md w-full">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">Delete Role</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Are you sure you want to delete <span id="delete-role-name-display" class="font-medium text-gray-900"></span>? This cannot be undone.
                    </p>
                    <div class="mt-6 flex gap-3">
                        <button id="confirm-delete-role" class="flex-1 px-4 py-2.5 text-sm font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 transition-colors shadow-sm">Yes, Delete</button>
                        <button id="cancel-delete-role" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Cancel</button>
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

        const createModal = document.getElementById('create-role-modal');
        const editModal = document.getElementById('edit-role-modal');
        const deletePopup = document.getElementById('delete-role-popup');

        function openCreateModal() {
            createModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            lucide.createIcons();
        }
        function closeCreateModal() {
            createModal.classList.add('hidden');
            document.body.style.overflow = '';
            document.getElementById('create-role-form').reset();
        }
        document.querySelectorAll('#open-create-role-modal, #open-create-role-modal-empty').forEach(btn => {
            if (btn) btn.addEventListener('click', openCreateModal);
        });
        document.querySelectorAll('.close-create-role-modal').forEach(btn => btn.addEventListener('click', closeCreateModal));
        createModal.addEventListener('click', function(e) { if (e.target === createModal) closeCreateModal(); });

        const editRoleDataUrl = '{{ route("admin.roles.data", ["role" => "__ID__"]) }}';
        const editRoleUpdateUrl = '{{ route("admin.roles.update", ["role" => "__ID__"]) }}';
        function openEditModal(roleId) {
            fetch(editRoleDataUrl.replace('__ID__', roleId), {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            }).then(r => r.json()).then(data => {
                document.getElementById('edit-role-form').action = editRoleUpdateUrl.replace('__ID__', data.id);
                document.getElementById('edit_role_name').value = data.name;
                document.querySelectorAll('.edit-role-permission-cb').forEach(cb => {
                    cb.checked = (data.permission_names || []).indexOf(cb.value) !== -1;
                });
                editModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                lucide.createIcons();
            }).catch(() => alert('Failed to load role.'));
        }
        function closeEditModal() {
            editModal.classList.add('hidden');
            document.body.style.overflow = '';
        }
        document.querySelectorAll('.edit-role').forEach(btn => {
            btn.addEventListener('click', function() { openEditModal(this.getAttribute('data-role-id')); });
        });
        document.querySelectorAll('.close-edit-role-modal').forEach(btn => btn.addEventListener('click', closeEditModal));
        editModal.addEventListener('click', function(e) { if (e.target === editModal) closeEditModal(); });

        let deleteRoleId = null;
        document.querySelectorAll('.delete-role').forEach(btn => {
            btn.addEventListener('click', function() {
                const usersCount = parseInt(this.getAttribute('data-users-count'), 10);
                if (usersCount > 0) {
                    alert('Cannot delete this role: it is assigned to ' + usersCount + ' user(s). Remove the role from all users first.');
                    return;
                }
                deleteRoleId = this.getAttribute('data-role-id');
                document.getElementById('delete-role-name-display').textContent = this.getAttribute('data-role-name');
                deletePopup.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                lucide.createIcons();
            });
        });
        document.getElementById('confirm-delete-role').addEventListener('click', function() {
            if (deleteRoleId) document.getElementById('delete-role-form-' + deleteRoleId).submit();
        });
        document.getElementById('cancel-delete-role').addEventListener('click', function() {
            deletePopup.classList.add('hidden');
            document.body.style.overflow = '';
            deleteRoleId = null;
        });
        deletePopup.addEventListener('click', function(e) {
            if (e.target === deletePopup) {
                deletePopup.classList.add('hidden');
                document.body.style.overflow = '';
                deleteRoleId = null;
            }
        });

        const exportRolesTrigger = document.getElementById('export-roles-dropdown-trigger');
        const exportRolesDropdown = document.getElementById('export-roles-dropdown');
        if (exportRolesTrigger && exportRolesDropdown) {
            exportRolesTrigger.addEventListener('click', function(e) { e.stopPropagation(); exportRolesDropdown.classList.toggle('hidden'); });
            document.addEventListener('click', function() { exportRolesDropdown.classList.add('hidden'); });
        }
        function getSelectedRoleIds() { return Array.from(document.querySelectorAll('.role-row-cb:checked')).map(cb => cb.value); }
        function updateRolesBulkBar() {
            const ids = getSelectedRoleIds();
            const bar = document.getElementById('roles-bulk-bar');
            const countEl = document.getElementById('roles-bulk-count');
            const csvLink = document.getElementById('roles-bulk-export-csv');
            const pdfLink = document.getElementById('roles-bulk-export-pdf');
            if (!bar || !countEl) return;
            if (ids.length === 0) { bar.classList.add('hidden'); return; }
            bar.classList.remove('hidden');
            countEl.textContent = ids.length + ' selected';
            const params = new URLSearchParams(window.location.search);
            ids.forEach(id => params.append('ids[]', id));
            csvLink.href = '{{ url("admin/roles/export/csv") }}?' + params.toString();
            pdfLink.href = '{{ url("admin/roles/export/pdf") }}?' + params.toString();
        }
        document.getElementById('roles-select-all')?.addEventListener('change', function() {
            document.querySelectorAll('.role-row-cb').forEach(cb => { cb.checked = this.checked; });
            updateRolesBulkBar();
        });
        document.querySelectorAll('.role-row-cb').forEach(cb => cb.addEventListener('change', updateRolesBulkBar));
        document.getElementById('roles-bulk-delete')?.addEventListener('click', function() {
            const ids = getSelectedRoleIds();
            if (ids.length === 0) return;
            if (!confirm('Delete ' + ids.length + ' selected role(s)?')) return;
            const form = document.getElementById('roles-bulk-form');
            form.querySelectorAll('input[name="ids[]"]').forEach(el => el.remove());
            ids.forEach(id => { const i = document.createElement('input'); i.type = 'hidden'; i.name = 'ids[]'; i.value = id; form.appendChild(i); });
            form.submit();
        });
    });
</script>
@endsection
