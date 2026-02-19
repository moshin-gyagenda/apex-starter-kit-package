<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Apex Starter Kit') }} - Verify Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '{{ config("theme.primary_palette.50") }}',
                            100: '{{ config("theme.primary_palette.100") }}',
                            200: '{{ config("theme.primary_palette.200") }}',
                            300: '{{ config("theme.primary_palette.300") }}',
                            400: '{{ config("theme.primary_palette.400") }}',
                            500: '{{ config("theme.primary_palette.500") }}',
                            600: '{{ config("theme.primary_palette.600") }}',
                            700: '{{ config("theme.primary_palette.700") }}',
                            800: '{{ config("theme.primary_palette.800") }}',
                            900: '{{ config("theme.primary_palette.900") }}',
                        },
                    },
                },
            },
        }
    </script>
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to bottom right, #f9fafb, #f3f4f6);
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Card Container -->
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <!-- Logo -->
                <div class="flex items-center justify-center mb-8">
                    @if(file_exists(public_path('assets/images/logo.png')))
                        <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name', 'Apex Starter Kit') }} Logo" class="h-16 w-16 rounded-full">
                    @else
                        <div class="h-16 w-16 rounded-full bg-primary-500 flex items-center justify-center">
                            <span class="text-white font-bold text-2xl">{{ substr(config('app.name', 'Apex Starter Kit'), 0, 1) }}</span>
                        </div>
                    @endif
                </div>

                <!-- Verify Email Content -->
                <div class="space-y-6">
                    <div class="mb-6 text-center">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="mail" class="w-8 h-8 text-primary-600"></i>
                        </div>
                        <h2 class="text-2xl text-gray-900 mb-2">Verify Your Email</h2>
                        <p class="text-gray-600">Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
                    </div>

                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                            <div class="font-medium">A new verification link has been sent to the email address you provided in your profile settings.</div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
                        @csrf

                        <button 
                            type="submit" 
                            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200"
                        >
                            Resend Verification Email
                        </button>
                    </form>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <a
                            href="{{ route('profile.show') }}"
                            class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors inline-flex items-center gap-1"
                        >
                            <i data-lucide="user" class="w-4 h-4"></i>
                            Edit Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors inline-flex items-center gap-1">
                                <i data-lucide="log-out" class="w-4 h-4"></i>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>
