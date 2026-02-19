@extends('backend.layouts.app')
@section('content')

    <div class="p-4 sm:ml-64 mt-16 flex flex-col min-h-screen">
        <!-- Page Header -->
        <div class="mb-6">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center">
                    <i data-lucide="users" class="w-6 h-6 text-primary-600"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
                    <p class="text-sm text-gray-500 mt-0.5">Manage users and their permissions • {{ $stats['total'] }} total users</p>
                </div>
            </div>
        </div>

        <!-- Success Message -->
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

        <!-- Error Message -->
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
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-primary-50 flex items-center justify-center">
                        <i data-lucide="users" class="w-6 h-6 text-primary-500"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Verified</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['verified'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-6 h-6 text-green-500"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Unverified</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['unverified'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-yellow-50 flex items-center justify-center">
                        <i data-lucide="alert-circle" class="w-6 h-6 text-yellow-500"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">With Roles</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $stats['with_roles'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-purple-50 flex items-center justify-center">
                        <i data-lucide="shield" class="w-6 h-6 text-purple-500"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg border border-gray-200 p-4 mb-6">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search by name, email, or role..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm"
                        >
                    </div>
                </div>
                <div class="sm:w-48">
                    <select
                        name="role"
                        class="w-full py-2.5 px-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition text-sm bg-white"
                    >
                        <option value="">All Roles</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('-', ' ', $role->name)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button
                    type="submit"
                    class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition text-sm font-medium"
                >
                    Filter
                </button>
                @if(request('search') || request('role'))
                    <a
                        href="{{ route('admin.users.index') }}"
                        class="px-4 py-2.5 bg-white text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium border border-gray-300 text-sm flex items-center justify-center gap-2"
                    >
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Users Table Section -->
        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Users</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Complete list of users and their status</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <div class="relative group">
                            <button type="button" id="export-users-dropdown-trigger" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm">
                                <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                                Export
                                <i data-lucide="chevron-down" class="w-4 h-4 ml-1"></i>
                            </button>
                            <div id="export-users-dropdown" class="hidden absolute right-0 mt-1 w-48 bg-white rounded-lg border border-gray-200 shadow-lg py-1 z-20">
                                <a href="{{ route('admin.users.export.csv', request()->query()) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i data-lucide="file-text" class="w-4 h-4 mr-2 text-gray-500"></i>
                                    Export all CSV
                                </a>
                                <a href="{{ route('admin.users.export.pdf', request()->query()) }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i data-lucide="file" class="w-4 h-4 mr-2 text-gray-500"></i>
                                    Export all PDF
                                </a>
                            </div>
                        </div>
                        <button type="button" id="open-add-user-modal" class="inline-flex items-center px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors font-medium text-sm shadow-sm hover:shadow-md">
                            <i data-lucide="user-plus" class="w-4 h-4 mr-2"></i>
                            Add New User
                        </button>
                    </div>
                </div>
                <!-- Bulk actions bar (hidden by default) -->
                <div id="users-bulk-bar" class="hidden mt-3 pt-3 border-t border-gray-200 flex flex-wrap items-center gap-2">
                    <span id="users-bulk-count" class="text-sm font-medium text-gray-700">0 selected</span>
                    <a id="users-bulk-export-csv" href="#" class="inline-flex items-center px-3 py-1.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Export selected CSV</a>
                    <a id="users-bulk-export-pdf" href="#" class="inline-flex items-center px-3 py-1.5 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">Export selected PDF</a>
                    <button type="button" id="users-bulk-delete" class="inline-flex items-center px-3 py-1.5 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg hover:bg-red-100">Delete selected</button>
                </div>
            </div>

            <div id="users-content">
                @if($users->isEmpty())
                    <div class="flex flex-col items-center justify-center py-16">
                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                            <i data-lucide="users" class="w-10 h-10 text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">No users found</h3>
                        <p class="text-sm text-gray-500 text-center max-w-sm mb-6">
                            You don't have any users yet. Add your first user to get started.
                        </p>
                        <button
                            id="open-add-user-modal-empty"
                            class="inline-flex items-center px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors font-medium text-sm shadow-sm hover:shadow-md"
                        >
                            <i data-lucide="user-plus" class="w-4 h-4 mr-2"></i>
                            Add Your First User
                        </button>
                    </div>
                @else
                    <form id="users-bulk-form" action="{{ route('admin.users.bulk-destroy') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="border-b bg-gray-50">
                                    <th class="py-3.5 px-5 w-10">
                                        <input type="checkbox" id="users-select-all" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500" title="Select all">
                                    </th>
                                    <th class="py-3.5 px-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">#</th>
                                    <th class="py-3.5 px-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">User</th>
                                    <th class="py-3.5 px-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden lg:table-cell">Email</th>
                                    <th class="py-3.5 px-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden md:table-cell">Role</th>
                                    <th class="py-3.5 px-5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider hidden lg:table-cell">Status</th>
                                    <th class="py-3.5 px-5 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider w-[120px]">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                    <tr class="border-b hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-5 w-10">
                                            @if($user->id !== auth()->id())
                                                <input type="checkbox" class="user-row-cb rounded border-gray-300 text-primary-600 focus:ring-primary-500" value="{{ $user->id }}" data-user-id="{{ $user->id }}">
                                            @else
                                                <span class="text-gray-300">—</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-5 text-sm text-gray-600 font-medium">{{ $user->id }}</td>
                                        <td class="py-4 px-5">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center border-2 border-primary-200">
                                                    <span class="text-sm font-semibold text-primary-600">{{ substr($user->name, 0, 1) }}</span>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-sm text-gray-900">{{ $user->name }}</div>
                                                    <div class="text-xs text-gray-500 lg:hidden">{{ $user->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-5 text-sm text-gray-600 hidden lg:table-cell">{{ $user->email }}</td>
                                        <td class="py-4 px-5 hidden md:table-cell">
                                            @if($user->roles->isNotEmpty())
                                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-primary-100 text-primary-700 border border-primary-200">
                                                    {{ ucfirst(str_replace('-', ' ', $user->roles->first()->name)) }}
                                                </span>
                                            @else
                                                <span class="text-gray-400 text-sm">—</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-5 hidden lg:table-cell">
                                            @if($user->email_verified_at)
                                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700 border border-green-200">
                                                    Verified
                                                </span>
                                            @else
                                                <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700 border border-yellow-200">
                                                    Unverified
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-5 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('admin.users.show', $user->id) }}" class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors" title="View">
                                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user->id) }}" class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition-colors" title="Edit">
                                                    <i data-lucide="edit" class="w-4 h-4"></i>
                                                </a>
                                                <button
                                                    type="button"
                                                    class="delete-button p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                    title="Delete"
                                                    data-user-id="{{ $user->id }}"
                                                    data-user-name="{{ $user->name }}">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                                <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="hidden">
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
                    
                    @include('backend.partials.pagination', ['paginator' => $users, 'showPerPage' => true])
                @endif
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div id="add-user-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col">
            <!-- Modal Header -->
            <div class="px-6 py-5 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary-100 flex items-center justify-center">
                        <i data-lucide="user-plus" class="w-6 h-6 text-primary-600"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Add New User</h3>
                        <p class="text-sm text-gray-500">Create a new user account</p>
                    </div>
                </div>
                <button id="close-add-user-modal" class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="flex-1 overflow-y-auto px-6 py-5">
                <form id="add-user-form" action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <!-- Personal Information Section -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                                <i data-lucide="user" class="w-4 h-4 mr-2 text-primary-500"></i>
                                Personal Information
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="modal_name" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="modal_name"
                                        value="{{ old('name') }}"
                                        placeholder="Enter full name"
                                        required
                                        class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm"
                                    >
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="modal_email" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="modal_email"
                                        value="{{ old('email') }}"
                                        placeholder="Enter email address"
                                        required
                                        class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm"
                                    >
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                                <i data-lucide="lock" class="w-4 h-4 mr-2 text-primary-500"></i>
                                Password
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="modal_password" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Password <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="password"
                                        name="password"
                                        id="modal_password"
                                        placeholder="Enter password"
                                        required
                                        class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm"
                                    >
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="modal_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Confirm Password <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="modal_password_confirmation"
                                        placeholder="Confirm password"
                                        required
                                        class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Account Settings Section -->
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                                <i data-lucide="settings" class="w-4 h-4 mr-2 text-primary-500"></i>
                                Account Settings
                            </h4>
                            <div>
                                <label for="modal_role" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Role <span class="text-red-500">*</span>
                                </label>
                                <select
                                    id="modal_role"
                                    name="role"
                                    required
                                    class="w-full py-2 px-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm"
                                >
                                    <option value="" disabled selected>Select a role</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                            {{ ucfirst(str_replace('-', ' ', $role->name)) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end gap-3">
                <button
                    id="cancel-add-user-modal"
                    type="button"
                    class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors"
                >
                    Cancel
                </button>
                <button
                    id="submit-add-user-form"
                    type="button"
                    class="px-4 py-2 bg-primary-500 text-white rounded-lg hover:bg-primary-600 transition-colors font-medium text-sm shadow-sm hover:shadow-md"
                >
                    <i data-lucide="save" class="w-4 h-4 mr-2 inline"></i>
                    Create User
                </button>
            </div>
        </div>
    </div>

    <!-- Confirmation Popup -->
    <div id="confirmation-popup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg border border-gray-200 p-6 max-w-md w-full">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900">Delete User</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Are you sure you want to delete <span id="user-name-display" class="font-medium text-gray-900"></span>? This action cannot be undone.
                    </p>
                    <div class="mt-6 flex gap-3">
                        <button id="confirm-delete" class="flex-1 px-4 py-2.5 text-sm font-medium text-white bg-red-500 rounded-lg hover:bg-red-600 transition-colors shadow-sm">
                            Yes, Delete
                        </button>
                        <button id="cancel-delete" class="flex-1 px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Lucide icons
        lucide.createIcons();

        // Close alert messages
        document.querySelectorAll('.close-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.alert-message').remove();
            });
        });

        // Modal functionality
        const modal = document.getElementById('add-user-modal');
        const openModalBtns = document.querySelectorAll('#open-add-user-modal, #open-add-user-modal-empty');
        const closeModalBtn = document.getElementById('close-add-user-modal');
        const cancelModalBtn = document.getElementById('cancel-add-user-modal');
        const submitFormBtn = document.getElementById('submit-add-user-form');

        function openModal() {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            lucide.createIcons();
        }

        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
            // Reset form
            document.getElementById('add-user-form').reset();
        }

        openModalBtns.forEach(btn => {
            btn.addEventListener('click', openModal);
        });

        closeModalBtn.addEventListener('click', closeModal);
        cancelModalBtn.addEventListener('click', closeModal);

        // Close modal when clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });

        // Submit form
        submitFormBtn.addEventListener('click', function() {
            document.getElementById('add-user-form').submit();
        });

        // Delete confirmation popup
        let deleteFormId = null;
        const deleteButtons = document.querySelectorAll('.delete-button');
        const popup = document.getElementById('confirmation-popup');
        const userNameDisplay = document.getElementById('user-name-display');
        const confirmDeleteBtn = document.getElementById('confirm-delete');
        const cancelDeleteBtn = document.getElementById('cancel-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                deleteFormId = this.getAttribute('data-user-id');
                const userName = this.getAttribute('data-user-name');
                userNameDisplay.textContent = userName;
                popup.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
        });

        confirmDeleteBtn.addEventListener('click', function() {
            if (deleteFormId) {
                document.getElementById('delete-form-' + deleteFormId).submit();
            }
        });

        cancelDeleteBtn.addEventListener('click', function() {
            popup.classList.add('hidden');
            document.body.style.overflow = '';
            deleteFormId = null;
        });

        // Close popup when clicking outside
        popup.addEventListener('click', function(e) {
            if (e.target === popup) {
                popup.classList.add('hidden');
                document.body.style.overflow = '';
                deleteFormId = null;
            }
        });

        // Export dropdown
        const exportTrigger = document.getElementById('export-users-dropdown-trigger');
        const exportDropdown = document.getElementById('export-users-dropdown');
        if (exportTrigger && exportDropdown) {
            exportTrigger.addEventListener('click', function(e) {
                e.stopPropagation();
                exportDropdown.classList.toggle('hidden');
            });
            document.addEventListener('click', function() { exportDropdown.classList.add('hidden'); });
        }

        // Bulk actions: get selected IDs
        function getSelectedUserIds() {
            return Array.from(document.querySelectorAll('.user-row-cb:checked')).map(cb => cb.value);
        }
        function updateBulkBar() {
            const ids = getSelectedUserIds();
            const bar = document.getElementById('users-bulk-bar');
            const countEl = document.getElementById('users-bulk-count');
            const csvLink = document.getElementById('users-bulk-export-csv');
            const pdfLink = document.getElementById('users-bulk-export-pdf');
            if (!bar || !countEl) return;
            if (ids.length === 0) {
                bar.classList.add('hidden');
                return;
            }
            bar.classList.remove('hidden');
            countEl.textContent = ids.length + ' selected';
            const base = '{{ route("admin.users.index") }}';
            const params = new URLSearchParams(window.location.search);
            ids.forEach(id => params.append('ids[]', id));
            csvLink.href = '{{ url("admin/users/export/csv") }}?' + params.toString();
            pdfLink.href = '{{ url("admin/users/export/pdf") }}?' + params.toString();
        }
        document.getElementById('users-select-all')?.addEventListener('change', function() {
            document.querySelectorAll('.user-row-cb').forEach(cb => { cb.checked = this.checked; });
            updateBulkBar();
        });
        document.querySelectorAll('.user-row-cb').forEach(cb => {
            cb.addEventListener('change', updateBulkBar);
        });
        document.getElementById('users-bulk-delete')?.addEventListener('click', function() {
            const ids = getSelectedUserIds();
            if (ids.length === 0) return;
            if (!confirm('Delete ' + ids.length + ' selected user(s)? This cannot be undone.')) return;
            const form = document.getElementById('users-bulk-form');
            form.querySelectorAll('input[name="ids[]"]').forEach(el => el.remove());
            ids.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                form.appendChild(input);
            });
            form.submit();
        });
    });
</script>
@endsection
