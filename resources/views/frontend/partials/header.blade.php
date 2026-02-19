<!-- Navigation Header - No visible border, clean white background -->
<nav class="fixed top-0 w-full z-50 bg-white/95 backdrop-blur-lg" style="border-bottom: none;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('frontend.index') }}" class="flex items-center">
                    @if(file_exists(public_path('assets/images/logo.png')))
                        <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name') }} Logo" class="h-8 w-8 mr-2 rounded">
                    @else
                        <div class="h-8 w-8 rounded-lg bg-primary-500 flex items-center justify-center mr-2">
                            <span class="text-white font-bold text-sm">{{ substr(config('app.name', 'App'), 0, 1) }}</span>
                        </div>
                    @endif
                    <span class="text-lg font-bold text-gray-900 tracking-tight">{{ config('app.name', 'Your App') }}</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1">
                <!-- Home -->
                <a href="{{ route('frontend.index') }}#home" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 rounded-lg h-9 flex items-center">
                    Home
                </a>

                <!-- Product Dropdown -->
                <div class="relative group" id="nav-product">
                    <button class="flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 rounded-lg h-9">
                        Product
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-[600px] bg-white rounded-lg mega-menu opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-200">
                        <div class="p-6 grid grid-cols-2 gap-8">
                            <div>
                                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">OVERVIEW</h3>
                                <div class="space-y-4">
                                    <a href="{{ route('frontend.index') }}#features" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-primary-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-primary-100 transition-colors">
                                            <i data-lucide="sparkles" class="w-5 h-5 text-primary-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Features</div>
                                            <div class="text-sm text-gray-600">What we offer</div>
                                        </div>
                                    </a>
                                    <a href="#" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-blue-100 transition-colors">
                                            <i data-lucide="rocket" class="w-5 h-5 text-blue-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Pricing</div>
                                            <div class="text-sm text-gray-600">Choose your plan</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">RESOURCES</h3>
                                <div class="space-y-4">
                                    <a href="#" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-green-100 transition-colors">
                                            <i data-lucide="book" class="w-5 h-5 text-green-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Documentation</div>
                                            <div class="text-sm text-gray-600">Get started guides</div>
                                        </div>
                                    </a>
                                    <a href="#" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-purple-100 transition-colors">
                                            <i data-lucide="video" class="w-5 h-5 text-purple-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Tutorials</div>
                                            <div class="text-sm text-gray-600">Video walkthroughs</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Dropdown - Mega Menu -->
                <div class="relative group" id="nav-features">
                    <button class="flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 rounded-lg h-9">
                        Features
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-[700px] bg-white rounded-xl mega-menu opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50" style="border: 0.5px solid rgba(229, 231, 235, 0.5);">
                        <div class="p-6 grid grid-cols-3 gap-8">
                            <!-- Column 1: PRODUCT -->
                            <div>
                                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">PRODUCT</h3>
                                <div class="space-y-4">
                                    <a href="{{ route('frontend.index') }}#features" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-primary-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-primary-100 transition-colors">
                                            <i data-lucide="zap" class="w-5 h-5 text-primary-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Key Features</div>
                                            <div class="text-sm text-gray-600">Discover what makes us unique</div>
                                        </div>
                                    </a>
                                    <a href="{{ route('frontend.index') }}#about" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-blue-100 transition-colors">
                                            <i data-lucide="info" class="w-5 h-5 text-blue-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">About Us</div>
                                            <div class="text-sm text-gray-600">Learn more about our mission</div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Column 2: SOLUTIONS -->
                            <div>
                                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">SOLUTIONS</h3>
                                <div class="space-y-4">
                                    <a href="#" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-green-100 transition-colors">
                                            <i data-lucide="check-circle" class="w-5 h-5 text-green-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Use Cases</div>
                                            <div class="text-sm text-gray-600">Real-world applications</div>
                                        </div>
                                    </a>
                                    <a href="#" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-purple-100 transition-colors">
                                            <i data-lucide="layers" class="w-5 h-5 text-purple-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Integrations</div>
                                            <div class="text-sm text-gray-600">Connect with your tools</div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Column 3: Featured -->
                            <div class="featured-primary rounded-xl p-5 relative overflow-hidden">
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-primary-600 text-white text-xs font-semibold rounded-md">
                                        <i data-lucide="star" class="w-3 h-3"></i>
                                        Featured
                                    </span>
                                </div>
                                <div class="mt-8">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">Get Started Today</h3>
                                    <p class="text-sm text-gray-700 mb-4 leading-relaxed">
                                        Start building amazing applications with our comprehensive starter kit. Everything you need in one place.
                                    </p>
                                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition-colors">
                                        Start Project
                                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resources Dropdown - Mega Menu -->
                <div class="relative group" id="nav-resources">
                    <button class="flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 rounded-lg h-9">
                        Resources
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-[700px] bg-white rounded-xl mega-menu opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50" style="border: 0.5px solid rgba(229, 231, 235, 0.5);">
                        <div class="p-6 grid grid-cols-3 gap-8">
                            <!-- Column 1: LEARN -->
                            <div>
                                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">LEARN</h3>
                                <div class="space-y-4">
                                    <a href="#" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-blue-100 transition-colors">
                                            <i data-lucide="book-open" class="w-5 h-5 text-blue-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Documentation</div>
                                            <div class="text-sm text-gray-600">Technical guides and API docs</div>
                                        </div>
                                    </a>
                                    <a href="#" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-green-100 transition-colors">
                                            <i data-lucide="file-text" class="w-5 h-5 text-green-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Case Studies</div>
                                            <div class="text-sm text-gray-600">Success stories from clients</div>
                                        </div>
                                    </a>
                                    <a href="#" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-purple-100 transition-colors">
                                            <i data-lucide="file-code" class="w-5 h-5 text-purple-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Blog</div>
                                            <div class="text-sm text-gray-600">Tech insights and trends</div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Column 2: SUPPORT -->
                            <div>
                                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">SUPPORT</h3>
                                <div class="space-y-4">
                                    <a href="#" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-yellow-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-yellow-100 transition-colors">
                                            <i data-lucide="help-circle" class="w-5 h-5 text-yellow-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Help Center</div>
                                            <div class="text-sm text-gray-600">FAQs and troubleshooting</div>
                                        </div>
                                    </a>
                                    <a href="#" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-indigo-100 transition-colors">
                                            <i data-lucide="users" class="w-5 h-5 text-indigo-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Community</div>
                                            <div class="text-sm text-gray-600">Join our developer community</div>
                                        </div>
                                    </a>
                                    <a href="{{ route('frontend.index') }}#about" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-blue-100 transition-colors">
                                            <i data-lucide="info" class="w-5 h-5 text-blue-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">About</div>
                                            <div class="text-sm text-gray-600">Learn more about us</div>
                                        </div>
                                    </a>
                                    <a href="{{ route('frontend.index') }}#contact" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-teal-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-teal-100 transition-colors">
                                            <i data-lucide="mail" class="w-5 h-5 text-teal-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Contact</div>
                                            <div class="text-sm text-gray-600">Get in touch with us</div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!-- Column 3: Featured Resource -->
                            <div class="featured-green rounded-xl p-5 relative overflow-hidden">
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-green-600 text-white text-xs font-semibold rounded-md">
                                        <i data-lucide="star" class="w-3 h-3"></i>
                                        Latest Resource
                                    </span>
                                </div>
                                <div class="mt-8">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">2024 Tech Report</h3>
                                    <p class="text-sm text-gray-700 mb-4 leading-relaxed">
                                        Insights on digital transformation trends and technology adoption across the region.
                                    </p>
                                    <a href="#" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                                        Download Report
                                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services Dropdown -->
                <div class="relative group" id="nav-services">
                    <button class="flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 rounded-lg h-9">
                        Services
                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180"></i>
                    </button>
                    <div class="absolute top-full left-0 mt-2 w-[500px] bg-white rounded-xl mega-menu opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50" style="border: 0.5px solid rgba(229, 231, 235, 0.5);">
                        <div class="p-6 grid grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">SERVICES</h3>
                                <div class="space-y-4">
                                    <a href="#" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-indigo-100 transition-colors">
                                            <i data-lucide="code" class="w-5 h-5 text-indigo-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Development</div>
                                            <div class="text-sm text-gray-600">Custom solutions</div>
                                        </div>
                                    </a>
                                    <a href="#" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-teal-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-teal-100 transition-colors">
                                            <i data-lucide="palette" class="w-5 h-5 text-teal-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Design</div>
                                            <div class="text-sm text-gray-600">UI/UX services</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">SUPPORT</h3>
                                <div class="space-y-4">
                                    <a href="#" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-orange-100 transition-colors">
                                            <i data-lucide="headphones" class="w-5 h-5 text-orange-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Consulting</div>
                                            <div class="text-sm text-gray-600">Expert guidance</div>
                                        </div>
                                    </a>
                                    <a href="#" class="flex items-start gap-3 group/item hover:opacity-80 transition-opacity">
                                        <div class="w-10 h-10 rounded-lg bg-cyan-50 flex items-center justify-center flex-shrink-0 group-hover/item:bg-cyan-100 transition-colors">
                                            <i data-lucide="wrench" class="w-5 h-5 text-cyan-600"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 group-hover/item:text-primary-600 mb-1">Maintenance</div>
                                            <div class="text-sm text-gray-600">Ongoing support</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pricing -->
                <a href="#" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-all duration-200 rounded-lg h-9 flex items-center">
                    Pricing
                </a>
            </div>

            <!-- Right Side Buttons -->
            <div class="hidden md:flex items-center space-x-3">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-200 flex items-center gap-2 h-9">
                        Dashboard
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                @else
                    <a href="#" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">
                        Get a quote
                    </a>
                    @if(Route::has('register'))
                        <a href="{{ route('register') }}" class="px-5 py-2 text-sm font-medium bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-all duration-200 flex items-center gap-2 h-9 shadow-sm">
                            Start project
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-medium bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-all duration-200 flex items-center gap-2 h-9 shadow-sm">
                            Start project
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t" style="border-top: 0.5px solid rgba(229, 231, 235, 0.3);">
            <div class="px-4 py-4 space-y-1">
                <!-- Home -->
                <a href="{{ route('frontend.index') }}#home" class="block px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 font-medium">Home</a>
                
                <!-- Features Dropdown -->
                <div class="space-y-1">
                    <button id="mobile-features-btn" class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 font-medium">
                        <span>Features</span>
                        <i data-lucide="chevron-down" id="mobile-features-icon" class="w-4 h-4 transition-transform duration-200"></i>
                    </button>
                    <div id="mobile-features-dropdown" class="hidden pl-4 space-y-1">
                        <a href="{{ route('frontend.index') }}#features" class="block px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 text-sm">
                            <div class="font-medium">Key Features</div>
                            <div class="text-xs text-gray-600 mt-0.5">Discover what makes us unique</div>
                        </a>
                        <a href="{{ route('frontend.index') }}#about" class="block px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 text-sm">
                            <div class="font-medium">About Us</div>
                            <div class="text-xs text-gray-600 mt-0.5">Learn more about our mission</div>
                        </a>
                    </div>
                </div>

                <!-- Resources Dropdown -->
                <div class="space-y-1">
                    <button id="mobile-resources-btn" class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 font-medium">
                        <span>Resources</span>
                        <i data-lucide="chevron-down" id="mobile-resources-icon" class="w-4 h-4 transition-transform duration-200"></i>
                    </button>
                    <div id="mobile-resources-dropdown" class="hidden pl-4 space-y-1">
                        <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 text-sm">
                            <div class="font-medium">Documentation</div>
                            <div class="text-xs text-gray-600 mt-0.5">Complete guides and tutorials</div>
                        </a>
                        <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 text-sm">
                            <div class="font-medium">Blog</div>
                            <div class="text-xs text-gray-600 mt-0.5">Latest news and updates</div>
                        </a>
                        <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 text-sm">
                            <div class="font-medium">Support</div>
                            <div class="text-xs text-gray-600 mt-0.5">Get help from our team</div>
                        </a>
                        <a href="{{ route('frontend.index') }}#about" class="block px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 text-sm">
                            <div class="font-medium">About</div>
                            <div class="text-xs text-gray-600 mt-0.5">Learn more about us</div>
                        </a>
                        <a href="{{ route('frontend.index') }}#contact" class="block px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 text-sm">
                            <div class="font-medium">Contact</div>
                            <div class="text-xs text-gray-600 mt-0.5">Get in touch with us</div>
                        </a>
                    </div>
                </div>

                <!-- Product Dropdown -->
                <div class="space-y-1">
                    <button id="mobile-product-btn" class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 font-medium">
                        <span>Product</span>
                        <i data-lucide="chevron-down" id="mobile-product-icon" class="w-4 h-4 transition-transform duration-200"></i>
                    </button>
                    <div id="mobile-product-dropdown" class="hidden pl-4 space-y-1">
                        <a href="{{ route('frontend.index') }}#features" class="block px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 text-sm">
                            <div class="font-medium">Features</div>
                            <div class="text-xs text-gray-600 mt-0.5">What we offer</div>
                        </a>
                        <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 text-sm">
                            <div class="font-medium">Pricing</div>
                            <div class="text-xs text-gray-600 mt-0.5">Choose your plan</div>
                        </a>
                    </div>
                </div>

                <!-- Services Dropdown -->
                <div class="space-y-1">
                    <button id="mobile-services-btn" class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 font-medium">
                        <span>Services</span>
                        <i data-lucide="chevron-down" id="mobile-services-icon" class="w-4 h-4 transition-transform duration-200"></i>
                    </button>
                    <div id="mobile-services-dropdown" class="hidden pl-4 space-y-1">
                        <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 text-sm">
                            <div class="font-medium">Development</div>
                            <div class="text-xs text-gray-600 mt-0.5">Custom solutions</div>
                        </a>
                        <a href="#" class="block px-4 py-2 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 text-sm">
                            <div class="font-medium">Design</div>
                            <div class="text-xs text-gray-600 mt-0.5">UI/UX services</div>
                        </a>
                    </div>
                </div>

                <!-- Pricing -->
                <a href="#" class="block px-4 py-3 rounded-lg hover:bg-gray-50 transition-colors text-gray-700 font-medium">Pricing</a>

                <!-- Auth Buttons -->
                <div class="pt-2 border-t mt-2 space-y-2" style="border-top: 0.5px solid rgba(229, 231, 235, 0.3);">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-lg bg-gray-900 text-white text-center font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="block px-4 py-3 rounded-lg border border-gray-300 text-center font-medium text-gray-700">Login</a>
                        @if(Route::has('register'))
                            <a href="{{ route('register') }}" class="block px-4 py-3 rounded-lg bg-gray-900 text-white text-center font-medium">Get Started</a>
                        @else
                            <a href="{{ route('login') }}" class="block px-4 py-3 rounded-lg bg-gray-900 text-white text-center font-medium">Get Started</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Spacer for fixed header -->
<div class="h-16"></div>
