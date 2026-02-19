<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Apex Starter Kit') }} - Dashboard</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Tom Select (searchable dropdowns) -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    
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
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                },
            },
        }
    </script>
    
    <style>
        :root {
            --color-primary: {{ config('theme.primary') }};
            --color-primary-50: {{ config('theme.primary_palette.50') }};
            --color-primary-100: {{ config('theme.primary_palette.100') }};
            --color-primary-200: {{ config('theme.primary_palette.200') }};
            --color-primary-300: {{ config('theme.primary_palette.300') }};
            --color-primary-400: {{ config('theme.primary_palette.400') }};
            --color-primary-500: {{ config('theme.primary_palette.500') }};
            --color-primary-600: {{ config('theme.primary_palette.600') }};
            --color-primary-700: {{ config('theme.primary_palette.700') }};
            --color-primary-800: {{ config('theme.primary_palette.800') }};
            --color-primary-900: {{ config('theme.primary_palette.900') }};
        }
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .sidebar-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar-scrollbar::-webkit-scrollbar-track {
            background: #f9fafb;
        }
        
        .sidebar-scrollbar::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 3px;
        }
        
        .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #9ca3af;
        }
        
        .border-l-3 {
            border-left-width: 3px;
        }
        
        .sidebar-item:hover {
            background-color: #f3f4f6;
        }
        
        .sidebar-item.active {
            color: var(--color-primary-600);
        }
        
        .chevron-icon {
            transition: transform 0.2s ease;
        }
        
        details[open] .chevron-icon {
            transform: rotate(90deg);
        }
    </style>
    @livewireStyles
</head>
<body class="bg-gray-50">
    <!-- Header -->
    @include('backend.partials.header')

    <!-- Sidebar -->
    @include('backend.partials.sidebar')

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('backend.partials.footer')

    @stack('modals')
    @yield('scripts')
    @livewireScripts
    <script>
        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') lucide.createIcons();
    </script>
</body>
</html>

