@extends('backend.layouts.app')

@section('content')
<div class="p-4 sm:ml-64 mt-16 flex flex-col min-h-screen">
    <!-- Page Header -->
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-lg bg-primary-100 flex items-center justify-center">
                <i data-lucide="user" class="w-6 h-6 text-primary-600"></i>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ __('Profile') }}</h1>
                <p class="text-sm text-gray-500 mt-0.5">{{ __('Manage your account settings and security.') }}</p>
            </div>
        </div>
    </div>

    <div class="container mx-auto py-6 px-4 sm:px-6">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')
            <x-section-border />
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            <div class="mt-6">
                @livewire('profile.update-password-form')
            </div>
            <x-section-border />
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            <div class="mt-6">
                @livewire('profile.two-factor-authentication-form')
            </div>
            <x-section-border />
        @endif

        <div class="mt-6">
            @livewire('profile.logout-other-browser-sessions-form')
        </div>

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            <x-section-border />
            <div class="mt-6">
                @livewire('profile.delete-user-form')
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') lucide.createIcons();
    });
</script>
@endsection
