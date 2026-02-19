<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Apex Starter Kit') }} - Register</title>
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

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                        <div class="font-medium">Whoops! Something went wrong.</div>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Register Form -->
                <div class="space-y-6">
                    <div class="mb-6">
                        <h2 class="text-2xl text-gray-900 mb-2">{{ config('app.name', 'Apex Starter Kit') }}</h2>
                        <p class="text-gray-600">Create your account to get started</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Name
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="user" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name') }}"
                                    required 
                                    autofocus
                                    autocomplete="name"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition"
                                    placeholder="John Doe"
                                    style="border-width: 1px;"
                                >
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="mail" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}"
                                    required 
                                    autocomplete="username"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition"
                                    placeholder="john@example.com"
                                    style="border-width: 1px;"
                                >
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="lock" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    required 
                                    autocomplete="new-password"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition"
                                    placeholder="Enter your password"
                                    style="border-width: 1px;"
                                >
                            </div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Confirm Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="lock" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    required 
                                    autocomplete="new-password"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition"
                                    placeholder="Confirm your password"
                                    style="border-width: 1px;"
                                >
                            </div>
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="flex items-start">
                                <input 
                                    id="terms" 
                                    name="terms" 
                                    type="checkbox" 
                                    required
                                    class="h-4 w-4 text-primary-500 focus:ring-primary-500 border-gray-300 rounded mt-1"
                                >
                                <label for="terms" class="ml-2 block text-sm text-gray-700">
                                    I agree to the 
                                    <a href="{{ route('terms.show') }}" target="_blank" class="text-primary-600 hover:text-primary-500">Terms of Service</a>
                                    and 
                                    <a href="{{ route('policy.show') }}" target="_blank" class="text-primary-600 hover:text-primary-500">Privacy Policy</a>
                                </label>
                            </div>
                        @endif

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200"
                        >
                            Create Account
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white text-gray-500">Or continue with</span>
                        </div>
                    </div>

                    <!-- Social Login Buttons -->
                    <div class="grid grid-cols-2 gap-3">
                        <!-- Google -->
                        <button 
                            type="button"
                            class="group relative w-full flex items-center justify-center gap-2 px-4 py-3 border-2 border-gray-200 rounded-lg bg-white hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 shadow-sm hover:shadow-md"
                            onclick="alert('Google login - UI only (no functionality)')"
                        >
                            <svg class="w-5 h-5" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-gray-900">Google</span>
                        </button>

                        <!-- GitHub -->
                        <button 
                            type="button"
                            class="group relative w-full flex items-center justify-center gap-2 px-4 py-3 border-2 border-gray-200 rounded-lg bg-white hover:bg-gray-900 hover:border-gray-900 transition-all duration-200 shadow-sm hover:shadow-md"
                            onclick="alert('GitHub login - UI only (no functionality)')"
                        >
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-sm font-medium text-gray-700 group-hover:text-white">GitHub</span>
                        </button>
                    </div>

                    <!-- Sign In Link -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-600">
                            Already registered? 
                            <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500 transition-colors">
                                Sign in
                            </a>
                        </p>
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
