<!-- Footer -->
<footer class="bg-gradient-to-b from-white to-gray-50/30 border-t py-16" style="border-top: 0.5px solid rgba(229, 231, 235, 0.3);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- Brand Column -->
            <div class="lg:col-span-1">
                <div class="flex items-center mb-6">
                    @if(file_exists(public_path('assets/images/logo.png')))
                        <img src="{{ asset('assets/images/logo.png') }}" alt="{{ config('app.name') }} Logo" class="h-12 w-12 mr-3 rounded-xl shadow-sm">
                    @else
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center mr-3 shadow-lg shadow-primary-500/20">
                            <span class="text-white font-bold text-xl">{{ substr(config('app.name', 'App'), 0, 1) }}</span>
                        </div>
                    @endif
                    <span class="text-xl font-bold text-gray-900 tracking-tight">{{ config('app.name', 'Your App') }}</span>
                </div>
                <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                    {{ config('app.description', 'A modern web application starter kit. Start building amazing things today.') }}
                </p>
                <div class="flex items-center space-x-2">
                    <!-- Facebook -->
                    <a href="#" class="group relative w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-500 flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-blue-500/30" aria-label="Facebook">
                        <i data-lucide="facebook" class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors"></i>
                    </a>
                    <!-- Twitter/X -->
                    <a href="#" class="group relative w-10 h-10 rounded-xl bg-gray-100 hover:bg-gray-900 flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-gray-900/30" aria-label="Twitter">
                        <i data-lucide="twitter" class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors"></i>
                    </a>
                    <!-- LinkedIn -->
                    <a href="#" class="group relative w-10 h-10 rounded-xl bg-gray-100 hover:bg-blue-600 flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-blue-600/30" aria-label="LinkedIn">
                        <i data-lucide="linkedin" class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors"></i>
                    </a>
                    <!-- Instagram -->
                    <a href="#" class="group relative w-10 h-10 rounded-xl bg-gray-100 hover:bg-gradient-to-br hover:from-purple-600 hover:via-pink-600 hover:to-orange-500 flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-pink-500/30" aria-label="Instagram">
                        <i data-lucide="instagram" class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors"></i>
                    </a>
                    <!-- YouTube -->
                    <a href="#" class="group relative w-10 h-10 rounded-xl bg-gray-100 hover:bg-red-600 flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-red-600/30" aria-label="YouTube">
                        <i data-lucide="youtube" class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors"></i>
                    </a>
                    <!-- GitHub -->
                    <a href="#" class="group relative w-10 h-10 rounded-xl bg-gray-100 hover:bg-gray-900 flex items-center justify-center transition-all duration-300 hover:scale-110 hover:shadow-lg hover:shadow-gray-900/30" aria-label="GitHub">
                        <i data-lucide="github" class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors"></i>
                    </a>
                </div>
            </div>

            <!-- Resources Column -->
            <div>
                <h4 class="text-gray-900 font-bold mb-6 tracking-tight text-sm uppercase">Resources</h4>
                <ul class="space-y-3 text-gray-600 text-sm">
                    <li>
                        <a href="{{ route('frontend.index') }}#features" class="group flex items-center hover:text-primary-600 transition-colors duration-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-transparent group-hover:bg-primary-600 mr-3 transition-all duration-200"></span>
                            Features
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.index') }}#about" class="group flex items-center hover:text-primary-600 transition-colors duration-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-transparent group-hover:bg-primary-600 mr-3 transition-all duration-200"></span>
                            About
                        </a>
                    </li>
                    <li>
                        <a href="#" class="group flex items-center hover:text-primary-600 transition-colors duration-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-transparent group-hover:bg-primary-600 mr-3 transition-all duration-200"></span>
                            Documentation
                        </a>
                    </li>
                    <li>
                        <a href="#" class="group flex items-center hover:text-primary-600 transition-colors duration-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-transparent group-hover:bg-primary-600 mr-3 transition-all duration-200"></span>
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="#" class="group flex items-center hover:text-primary-600 transition-colors duration-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-transparent group-hover:bg-primary-600 mr-3 transition-all duration-200"></span>
                            Support
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Company Column -->
            <div>
                <h4 class="text-gray-900 font-bold mb-6 tracking-tight text-sm uppercase">Company</h4>
                <ul class="space-y-3 text-gray-600 text-sm mb-8">
                    <li>
                        <a href="{{ route('frontend.index') }}#about" class="group flex items-center hover:text-primary-600 transition-colors duration-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-transparent group-hover:bg-primary-600 mr-3 transition-all duration-200"></span>
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="#" class="group flex items-center hover:text-primary-600 transition-colors duration-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-transparent group-hover:bg-primary-600 mr-3 transition-all duration-200"></span>
                            Team
                        </a>
                    </li>
                    <li>
                        <a href="#" class="group flex items-center hover:text-primary-600 transition-colors duration-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-transparent group-hover:bg-primary-600 mr-3 transition-all duration-200"></span>
                            Community
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('frontend.index') }}#contact" class="group flex items-center hover:text-primary-600 transition-colors duration-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-transparent group-hover:bg-primary-600 mr-3 transition-all duration-200"></span>
                            Contact
                        </a>
                    </li>
                </ul>
                <h4 class="text-gray-900 font-bold mb-6 tracking-tight text-sm uppercase">Legal</h4>
                <ul class="space-y-3 text-gray-600 text-sm">
                    <li>
                        <a href="#" class="group flex items-center hover:text-primary-600 transition-colors duration-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-transparent group-hover:bg-primary-600 mr-3 transition-all duration-200"></span>
                            Terms of Service
                        </a>
                    </li>
                    <li>
                        <a href="#" class="group flex items-center hover:text-primary-600 transition-colors duration-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-transparent group-hover:bg-primary-600 mr-3 transition-all duration-200"></span>
                            Privacy Policy
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div>
                <h4 class="text-gray-900 font-bold mb-6 tracking-tight text-sm uppercase">Contact</h4>
                <ul class="space-y-4 text-gray-600 text-sm">
                    <li>
                        <a href="mailto:contact@apexglobal.com" class="group flex items-start gap-3 hover:text-primary-600 transition-colors duration-200">
                            <div class="w-8 h-8 rounded-lg bg-primary-50 flex items-center justify-center flex-shrink-0 group-hover:bg-primary-100 transition-colors">
                                <i data-lucide="mail" class="w-4 h-4 text-primary-600"></i>
                            </div>
                            <span class="pt-1">contact@apexglobal.com</span>
                        </a>
                    </li>
                    <li>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-primary-50 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="phone" class="w-4 h-4 text-primary-600"></i>
                            </div>
                            <div class="pt-1 space-y-1">
                                <a href="tel:+256778777809" class="block hover:text-primary-600 transition-colors duration-200">0778777809</a>
                                <a href="tel:+256708833157" class="block hover:text-primary-600 transition-colors duration-200">0708833157</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-primary-50 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="map-pin" class="w-4 h-4 text-primary-600"></i>
                            </div>
                            <span class="pt-1 leading-relaxed">Kirinya-Bukasa Road Opposite PPF Party Offices, Uganda</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t pt-8" style="border-top: 0.5px solid rgba(229, 231, 235, 0.3);">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-gray-600 text-sm text-center md:text-left">
                    &copy; {{ date('Y') }} <span class="font-semibold text-gray-900">{{ config('app.name', 'Your App') }}</span>. All rights reserved.
                </p>
                <div class="flex items-center gap-6 text-xs text-gray-500">
                    <span>Made with <span class="text-red-500">♥</span> in Uganda</span>
                </div>
            </div>
        </div>
    </div>
</footer>
