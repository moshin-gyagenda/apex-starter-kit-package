<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Apex Starter Kit') }} - Two Factor Authentication</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        [x-cloak] { display: none !important; }
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

                <!-- Two Factor Challenge Form -->
                <div class="space-y-6" x-data="{ recovery: false }">
                    <div class="mb-6 text-center">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="shield" class="w-8 h-8 text-primary-600"></i>
                        </div>
                        <h2 class="text-2xl text-gray-900 mb-2">Two Factor Authentication</h2>
                        <p class="text-gray-600 text-sm" x-show="! recovery">
                            Please confirm access to your account by entering the authentication code provided by your authenticator application.
                        </p>
                        <p class="text-gray-600 text-sm" x-cloak x-show="recovery">
                            Please confirm access to your account by entering one of your emergency recovery codes.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('two-factor.login') }}" class="space-y-5">
                        @csrf

                        <!-- Authentication Code Field -->
                        <div x-show="! recovery">
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                Authentication Code
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="key" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="code" 
                                    name="code" 
                                    inputmode="numeric"
                                    autofocus
                                    x-ref="code"
                                    autocomplete="one-time-code"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition"
                                    placeholder="000000"
                                    style="border-width: 1px;"
                                >
                            </div>
                        </div>

                        <!-- Recovery Code Field -->
                        <div x-cloak x-show="recovery">
                            <label for="recovery_code" class="block text-sm font-medium text-gray-700 mb-2">
                                Recovery Code
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-lucide="key" class="h-5 w-5 text-gray-400"></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="recovery_code" 
                                    name="recovery_code" 
                                    x-ref="recovery_code"
                                    autocomplete="one-time-code"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition"
                                    placeholder="Enter recovery code"
                                    style="border-width: 1px;"
                                >
                            </div>
                        </div>

                        <!-- Toggle Buttons -->
                        <div class="flex items-center justify-between">
                            <button 
                                type="button" 
                                class="text-sm text-gray-600 hover:text-gray-900 transition-colors"
                                x-show="! recovery"
                                x-on:click="recovery = true; $nextTick(() => { $refs.recovery_code.focus() })"
                            >
                                Use a recovery code
                            </button>

                            <button 
                                type="button" 
                                class="text-sm text-gray-600 hover:text-gray-900 transition-colors"
                                x-cloak
                                x-show="recovery"
                                x-on:click="recovery = false; $nextTick(() => { $refs.code.focus() })"
                            >
                                Use an authentication code
                            </button>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-200"
                        >
                            Log in
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
