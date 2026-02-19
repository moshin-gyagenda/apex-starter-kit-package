@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section id="home" class="relative bg-gradient-to-br from-white via-gray-50/50 to-primary-50/30 py-28 lg:py-36 overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <h1 class="text-5xl sm:text-6xl font-bold text-gray-900 mb-6 tracking-tight leading-tight">
                    Welcome to {{ config('app.name', 'Your Application') }}
                </h1>
                <p class="text-xl text-gray-600 mb-12 max-w-3xl mx-auto leading-relaxed">
                    {{ config('app.description', 'Build amazing web applications with our modern starter kit. Everything you need to get started quickly.') }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    @auth
                        <a href="{{ route('dashboard') }}" class="group relative bg-gray-900 text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-gray-800 transition-all duration-300 inline-flex items-center justify-center shadow-lg hover:shadow-xl hover:scale-105">
                            Go to Dashboard
                            <i data-lucide="arrow-right" class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="group relative bg-gray-900 text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-gray-800 transition-all duration-300 inline-flex items-center justify-center shadow-lg hover:shadow-xl hover:scale-105">
                            Get Started
                            <i data-lucide="arrow-right" class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    @endauth
                    <a href="#features" class="group border border-gray-200 text-gray-700 px-8 py-4 rounded-xl text-lg font-semibold hover:bg-white hover:border-primary-300 hover:text-primary-600 transition-all duration-300 inline-flex items-center justify-center shadow-sm hover:shadow-md hover:scale-105">
                        Learn More
                        <i data-lucide="info" class="w-5 h-5 ml-2 group-hover:rotate-12 transition-transform"></i>
                    </a>
                </div>
                
                <!-- Trust Indicators -->
                <div class="mt-16 flex flex-wrap justify-center items-center gap-8 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-gray-400"></i>
                        <span>Open Source</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="shield" class="w-4 h-4 text-gray-400"></i>
                        <span>Secure</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="zap" class="w-4 h-4 text-gray-400"></i>
                        <span>Fast</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4 tracking-tight">What's Included</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Everything you need to start building your application right away
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group bg-white p-8 rounded-lg card-shadow hover:card-shadow-hover transition-all duration-300 border border-gray-200 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mb-5 group-hover:bg-gray-200 transition-colors">
                        <i data-lucide="zap" class="w-6 h-6 text-gray-700"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Fast Performance</h3>
                    <p class="text-gray-600 leading-relaxed">Optimized for speed and efficiency. Your applications will load quickly and run smoothly.</p>
                </div>

                <!-- Feature 2 -->
                <div class="group bg-white p-8 rounded-lg card-shadow hover:card-shadow-hover transition-all duration-300 border border-gray-200 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mb-5 group-hover:bg-gray-200 transition-colors">
                        <i data-lucide="shield-check" class="w-6 h-6 text-gray-700"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Security Built In</h3>
                    <p class="text-gray-600 leading-relaxed">Comes with authentication and security features already set up. No need to build from scratch.</p>
                </div>

                <!-- Feature 3 -->
                <div class="group bg-white p-8 rounded-lg card-shadow hover:card-shadow-hover transition-all duration-300 border border-gray-200 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mb-5 group-hover:bg-gray-200 transition-colors">
                        <i data-lucide="smartphone" class="w-6 h-6 text-gray-700"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Works Everywhere</h3>
                    <p class="text-gray-600 leading-relaxed">Responsive design that looks great on phones, tablets, and desktops.</p>
                </div>

                <!-- Feature 4 -->
                <div class="group bg-white p-8 rounded-lg card-shadow hover:card-shadow-hover transition-all duration-300 border border-gray-200 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mb-5 group-hover:bg-gray-200 transition-colors">
                        <i data-lucide="code" class="w-6 h-6 text-gray-700"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Modern Tech</h3>
                    <p class="text-gray-600 leading-relaxed">Built with current tools and best practices. Clean code that's easy to understand and maintain.</p>
                </div>

                <!-- Feature 5 -->
                <div class="group bg-white p-8 rounded-lg card-shadow hover:card-shadow-hover transition-all duration-300 border border-gray-200 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mb-5 group-hover:bg-gray-200 transition-colors">
                        <i data-lucide="users" class="w-6 h-6 text-gray-700"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">User System</h3>
                    <p class="text-gray-600 leading-relaxed">User accounts, roles, and permissions are already included. Just customize as needed.</p>
                </div>

                <!-- Feature 6 -->
                <div class="group bg-white p-8 rounded-lg card-shadow hover:card-shadow-hover transition-all duration-300 border border-gray-200 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mb-5 group-hover:bg-gray-200 transition-colors">
                        <i data-lucide="settings" class="w-6 h-6 text-gray-700"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Easy to Customize</h3>
                    <p class="text-gray-600 leading-relaxed">Change colors, add features, or modify layouts. Everything is organized and straightforward.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-gradient-to-b from-gray-50/50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6 tracking-tight">About {{ config('app.name', 'Our Application') }}</h2>
                    <p class="text-lg text-gray-600 mb-4 leading-relaxed">
                        We built this starter kit to help developers get projects up and running faster. Instead of starting from scratch every time, you can use this as your foundation.
                    </p>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        It includes the common things most projects need - user authentication, a dashboard, basic security features, and a clean frontend. You can use it for any type of web application and customize it to fit your specific needs.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-gray-50 border border-gray-200">
                            <i data-lucide="check" class="w-4 h-4 text-gray-600"></i>
                            <span class="text-gray-700 text-sm">Ready to use</span>
                        </div>
                        <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-gray-50 border border-gray-200">
                            <i data-lucide="check" class="w-4 h-4 text-gray-600"></i>
                            <span class="text-gray-700 text-sm">Well documented</span>
                        </div>
                        <div class="flex items-center gap-2 px-3 py-2 rounded-lg bg-gray-50 border border-gray-200">
                            <i data-lucide="check" class="w-4 h-4 text-gray-600"></i>
                            <span class="text-gray-700 text-sm">Regular updates</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-10 rounded-lg card-shadow border border-gray-200">
                    <div class="grid grid-cols-2 gap-8">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-gray-900 mb-2">100%</div>
                            <div class="text-sm text-gray-600">Open Source</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-gray-900 mb-2">24/7</div>
                            <div class="text-sm text-gray-600">Support</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-gray-900 mb-2">100+</div>
                            <div class="text-sm text-gray-600">Components</div>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-gray-900 mb-2">∞</div>
                            <div class="text-sm text-gray-600">Possibilities</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-28 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6 tracking-tight">
                Ready to Get Started?
            </h2>
            <p class="text-xl text-gray-300 mb-12 max-w-2xl mx-auto leading-relaxed">
                Start building your application today. Everything you need is ready to go.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                @auth
                    <a href="{{ route('dashboard') }}" class="group relative bg-white text-gray-900 px-10 py-4 rounded-xl text-lg font-bold hover:bg-gray-100 transition-all duration-300 inline-flex items-center justify-center shadow-2xl hover:shadow-white/20 hover:scale-105">
                        Go to Dashboard
                        <i data-lucide="arrow-right" class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="group relative bg-white text-gray-900 px-10 py-4 rounded-xl text-lg font-bold hover:bg-gray-100 transition-all duration-300 inline-flex items-center justify-center shadow-2xl hover:shadow-white/20 hover:scale-105">
                        Get Started Now
                        <i data-lucide="arrow-right" class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                @endauth
                <a href="#contact" class="group border border-white/30 text-white px-10 py-4 rounded-xl text-lg font-bold hover:bg-white/10 hover:border-white/50 transition-all duration-300 inline-flex items-center justify-center backdrop-blur-sm hover:scale-105">
                    Contact Us
                    <i data-lucide="mail" class="w-5 h-5 ml-2 group-hover:scale-110 transition-transform"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4 tracking-tight">Get in Touch</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Have questions? Send us a message and we'll get back to you.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-6">Contact Information</h3>
                        <div class="space-y-5">
                            <a href="mailto:contact@apexglobal.com" class="flex items-start gap-3 p-4 rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-sm transition-all">
                                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="mail" class="w-5 h-5 text-gray-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Email</h4>
                                    <p class="text-gray-600">contact@apexglobal.com</p>
                                </div>
                            </a>
                            <div class="flex items-start gap-3 p-4 rounded-lg border border-gray-200">
                                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="phone" class="w-5 h-5 text-gray-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-2">Phone</h4>
                                    <div class="space-y-1">
                                        <a href="tel:+256778777809" class="block text-gray-600 hover:text-gray-900 transition-colors">0778777809</a>
                                        <a href="tel:+256708833157" class="block text-gray-600 hover:text-gray-900 transition-colors">0708833157</a>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-4 rounded-lg border border-gray-200">
                                <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                                    <i data-lucide="map-pin" class="w-5 h-5 text-gray-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Address</h4>
                                    <p class="text-gray-600 leading-relaxed">Kirinya-Bukasa Road Opposite PPF Party Offices, Uganda</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-white p-8 rounded-lg card-shadow border border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Send us a Message</h3>
                    <form class="space-y-5">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm" required>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea id="message" name="message" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-primary-500 transition text-sm resize-none" required></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gray-900 text-white px-6 py-4 rounded-lg font-medium hover:bg-gray-800 transition-all duration-200">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush
