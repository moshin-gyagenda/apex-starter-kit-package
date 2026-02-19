<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Apex Starter Kit') }} - Confirm Password</title>
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

                <!-- Confirm Password Form -->
                <div class="space-y-6">
                    <div class="mb-6 text-center">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="shield-check" class="w-8 h-8 text-primary-600"></i>
                        </div>
                        <h2 class="text-2xl text-gray-900 mb-2">Confirm Password</h2>
                        <p class="text-gray-600">This is a secure area of the application. Please confirm your password before continuing.</p>
                    </div>

                    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                        @csrf

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
                                    autofocus
                                    autocomplete="current-password"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition"
                                    placeholder="Enter your password"
                                    style="border-width: 1px;"
                                >
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200"
                        >
                            Confirm
                        </button>
                    </form>
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
