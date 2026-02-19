<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Apex Starter Kit')) - {{ config('app.name', 'Apex Starter Kit') }}</title>
    
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
                    letterSpacing: {
                        tighter: '-0.02em',
                        tight: '-0.01em',
                    },
                },
            },
        }
    </script>
    
    <style>
        :root {
            --border: rgba(229, 231, 235, 0.3);
            --background: #fafafa;
            --foreground: #111827;
            --muted-foreground: #6b7280;
            --accent: rgba(249, 115, 22, 0.06);
            --card: #ffffff;
            --card-border: rgba(229, 231, 235, 0.5);
        }
        
        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            :root {
                --border: rgba(255, 255, 255, 0.08);
                --background: #0a0a0a;
                --foreground: #fafafa;
                --muted-foreground: #a1a1aa;
                --card: #18181b;
                --card-border: rgba(255, 255, 255, 0.1);
            }
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            color: var(--foreground);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom scrollbar - minimal */
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        
        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 3px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.3);
        }
        
        /* Next.js-style card shadows - very subtle */
        .card-shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04), 0 1px 2px 0 rgba(0, 0, 0, 0.02);
        }
        
        .card-shadow-hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.06), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        
        /* Utility classes */
        .border-border {
            border-color: var(--card-border);
            border-width: 0.5px;
        }
        
        .bg-background {
            background-color: var(--background);
        }
        
        .text-foreground {
            color: var(--foreground);
        }
        
        .text-muted-foreground {
            color: var(--muted-foreground);
        }
        
        .bg-accent {
            background-color: var(--accent);
        }
        
        .bg-card {
            background-color: var(--card);
        }
        
        /* Next.js-style subtle shadows */
        .shadow-elevated {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04), 0 1px 2px 0 rgba(0, 0, 0, 0.02);
        }
        
        .shadow-glow {
            box-shadow: 0 0 20px rgba(249, 115, 22, 0.15);
        }
        
        /* Mega menu dropdown styling */
        .mega-menu {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        /* Smooth dropdown animations */
        .dropdown-enter {
            opacity: 0;
            transform: translateY(-10px);
        }
        
        .dropdown-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.2s ease, transform 0.2s ease;
        }
        
        /* Ensure dropdowns don't overflow */
        .group:hover .absolute {
            max-width: calc(100vw - 2rem);
        }
        
        /* Featured section gradient backgrounds */
        .featured-primary {
            background: linear-gradient(135deg, rgba(249, 115, 22, 0.08) 0%, rgba(249, 115, 22, 0.04) 100%);
        }
        
        .featured-green {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.08) 0%, rgba(34, 197, 94, 0.04) 100%);
        }
        
        .backdrop-blur-lg {
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
        }
        
        /* Form elements - minimal borders */
        input, textarea, select {
            border-color: var(--card-border) !important;
            border-width: 0.5px !important;
            transition: all 0.2s ease;
        }
        
        input:focus, textarea:focus, select:focus {
            border-color: {{ config('theme.primary') }} !important;
            border-width: 0.5px !important;
            outline: none;
            box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        }
        
        /* Natural hover transitions */
        * {
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
        
        /* Tag/Badge styling - minimal borders */
        .tag {
            border: 0.5px solid var(--card-border);
            background-color: rgba(249, 115, 22, 0.05);
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            color: var(--muted-foreground);
        }
        
        /* Animated blob background */
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
        
        .animate-blob {
            animation: blob 7s infinite;
        }
        
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        
        .animation-delay-4000 {
            animation-delay: 4s;
        }
        
        /* Enhanced button hover effects */
        .btn-primary {
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .btn-primary:hover::before {
            width: 300px;
            height: 300px;
        }
        
        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }
        
        /* Enhanced card hover effects */
        .card-hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card-hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50/30">
    <!-- Header -->
    @include('frontend.partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('frontend.partials.footer')

    @stack('scripts')
    
    <script>
        // Initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            
            // Mobile menu toggle
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
            
            // Mobile dropdown toggles
            const mobileFeaturesBtn = document.getElementById('mobile-features-btn');
            const mobileFeaturesDropdown = document.getElementById('mobile-features-dropdown');
            const mobileFeaturesIcon = document.getElementById('mobile-features-icon');
            
            if (mobileFeaturesBtn && mobileFeaturesDropdown) {
                mobileFeaturesBtn.addEventListener('click', function() {
                    mobileFeaturesDropdown.classList.toggle('hidden');
                    if (mobileFeaturesIcon) {
                        mobileFeaturesIcon.classList.toggle('rotate-180');
                    }
                });
            }
            
            const mobileResourcesBtn = document.getElementById('mobile-resources-btn');
            const mobileResourcesDropdown = document.getElementById('mobile-resources-dropdown');
            const mobileResourcesIcon = document.getElementById('mobile-resources-icon');
            
            if (mobileResourcesBtn && mobileResourcesDropdown) {
                mobileResourcesBtn.addEventListener('click', function() {
                    mobileResourcesDropdown.classList.toggle('hidden');
                    if (mobileResourcesIcon) {
                        mobileResourcesIcon.classList.toggle('rotate-180');
                    }
                });
            }
            
            const mobileProductBtn = document.getElementById('mobile-product-btn');
            const mobileProductDropdown = document.getElementById('mobile-product-dropdown');
            const mobileProductIcon = document.getElementById('mobile-product-icon');
            
            if (mobileProductBtn && mobileProductDropdown) {
                mobileProductBtn.addEventListener('click', function() {
                    mobileProductDropdown.classList.toggle('hidden');
                    if (mobileProductIcon) {
                        mobileProductIcon.classList.toggle('rotate-180');
                    }
                });
            }
            
            const mobileServicesBtn = document.getElementById('mobile-services-btn');
            const mobileServicesDropdown = document.getElementById('mobile-services-dropdown');
            const mobileServicesIcon = document.getElementById('mobile-services-icon');
            
            if (mobileServicesBtn && mobileServicesDropdown) {
                mobileServicesBtn.addEventListener('click', function() {
                    mobileServicesDropdown.classList.toggle('hidden');
                    if (mobileServicesIcon) {
                        mobileServicesIcon.classList.toggle('rotate-180');
                    }
                });
            }
            
            // Keep dropdowns open when hovering (desktop)
            const dropdownGroups = document.querySelectorAll('.group');
            dropdownGroups.forEach(group => {
                const dropdown = group.querySelector('.absolute');
                if (dropdown) {
                    group.addEventListener('mouseenter', function() {
                        dropdown.classList.remove('invisible', 'opacity-0');
                        dropdown.classList.add('visible', 'opacity-100');
                    });
                    group.addEventListener('mouseleave', function() {
                        dropdown.classList.add('invisible', 'opacity-0');
                        dropdown.classList.remove('visible', 'opacity-100');
                    });
                }
            });
        });
    </script>
</body>
</html>
