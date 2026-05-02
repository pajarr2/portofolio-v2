<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $settings['tagline'] ?? 'Portfolio Website' }} - {{ $settings['name'] ?? 'Portfolio' }}">
    <title>{{ $settings['name'] ?? 'Portfolio' }} — @yield('title', 'Home')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#08101e] text-slate-200 antialiased">

    <!-- ── Background Ambient ── -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
        <div class="absolute top-0 left-1/4 w-[600px] h-[600px] rounded-full opacity-[0.06]"
             style="background: radial-gradient(circle, #0c90e9, transparent 70%); filter: blur(60px);"></div>
        <div class="absolute bottom-1/4 right-0 w-[500px] h-[500px] rounded-full opacity-[0.04]"
             style="background: radial-gradient(circle, #3B82F6, transparent 70%); filter: blur(80px);"></div>
        <div class="dot-grid absolute inset-0 opacity-30"></div>
    </div>

    <!-- ── Navbar ── -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500" x-data="{ open: false }">
        <div class="max-w-6xl mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <a href="{{ route('portfolio.index') }}" class="flex items-center gap-2 group">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center pulse-glow"
                         style="background: linear-gradient(135deg, #0c90e9, #0159a1);">
                        <span class="text-white font-bold text-sm">
                            {{ strtoupper(substr($settings['name'] ?? 'P', 0, 1)) }}
                        </span>
                    </div>
                    <span class="font-bold text-white group-hover:text-[#36aaf8] transition-colors font-display">
                        {{ $settings['name'] ?? 'Portfolio' }}
                    </span>
                </a>

                <!-- Desktop Nav -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('portfolio.index') }}#about" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Tentang</a>
                    <a href="{{ route('portfolio.index') }}#skills" class="nav-link">Skills</a>
                    <a href="{{ route('portfolio.projects') }}" class="nav-link {{ request()->is('projects*') ? 'active' : '' }}">Projects</a>
                    <a href="{{ route('portfolio.index') }}#experience" class="nav-link">Pengalaman</a>
                    <a href="{{ route('portfolio.contact') }}" class="nav-link {{ request()->is('contact') ? 'active' : '' }}">Kontak</a>
                </div>

                <div class="hidden md:flex items-center gap-3">
                    @if($settings['open_to_work'] ?? false)
                    <div class="flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold text-emerald-400"
                         style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3);">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Open to Work
                    </div>
                    @endif
                    <a href="{{ route('portfolio.contact') }}" class="btn-primary text-sm py-2 px-5">
                        <span>Hubungi Saya</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button @click="open = !open" class="md:hidden text-slate-400 hover:text-white transition-colors p-1.5 rounded-lg" style="background: rgba(255,255,255,0.05);">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Fullscreen Overlay -->
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            @click.away="open = false"
            class="md:hidden absolute top-full left-0 right-0 mx-4 mt-2 rounded-2xl shadow-2xl"
            style="background: rgba(8, 16, 30, 0.97); backdrop-filter: blur(24px); border: 1px solid rgba(12,144,233,0.2); z-index: 100;"
        >
            <div class="p-5 space-y-1">
                <a href="{{ route('portfolio.index') }}#about" @click="open = false" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all font-medium">Tentang</a>
                <a href="{{ route('portfolio.index') }}#skills" @click="open = false" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all font-medium">Skills</a>
                <a href="{{ route('portfolio.projects') }}" @click="open = false" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all font-medium">Projects</a>
                <a href="{{ route('portfolio.index') }}#experience" @click="open = false" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all font-medium">Pengalaman</a>
                <a href="{{ route('portfolio.contact') }}" @click="open = false" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all font-medium">Kontak</a>
                <div class="pt-3 border-t border-white/5">
                    <a href="{{ route('portfolio.contact') }}" @click="open = false" class="btn-primary w-full justify-center">
                        <span>Hubungi Saya</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ── Page Content ── -->
    <main class="relative z-10">
        @yield('content')
    </main>

    <!-- ── Footer ── -->
    <footer class="relative z-10 mt-20 border-t border-white/5">
        <div class="max-w-6xl mx-auto px-6 py-12">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center"
                         style="background: linear-gradient(135deg, #0c90e9, #0159a1);">
                        <span class="text-white font-bold text-xs">
                            {{ strtoupper(substr($settings['name'] ?? 'P', 0, 1)) }}
                        </span>
                    </div>
                    <p class="text-slate-500 text-sm">{{ $settings['footer_text'] ?? '© 2025 Portfolio. All rights reserved.' }}</p>
                </div>

                <!-- Social Links -->
                <div class="flex items-center gap-4">
                    @foreach($socials as $social)
                    <a href="{{ $social->url }}" target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:text-[#36aaf8] transition-all hover:scale-110 hover:-translate-y-1"
                       style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06);">
                        @include('partials.social-icon', ['platform' => $social->icon])
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </footer>

    <!-- Navbar scroll effect -->
    <script>
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(8, 16, 30, 0.95)';
                navbar.style.backdropFilter = 'blur(20px)';
                navbar.style.borderBottom = '1px solid rgba(12,144,233,0.1)';
            } else {
                navbar.style.background = 'transparent';
                navbar.style.backdropFilter = 'none';
                navbar.style.borderBottom = 'none';
            }
        });

        // Animate skill bars on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const fills = entry.target.querySelectorAll('[data-width]');
                    fills.forEach(fill => {
                        fill.style.width = fill.dataset.width;
                    });
                }
            });
        }, { threshold: 0.2 });

        document.querySelectorAll('.skills-section').forEach(el => observer.observe(el));

        // Animate elements on scroll
        const fadeObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.fade-in').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'all 0.7s ease';
            fadeObserver.observe(el);
        });
    </script>
</body>
</html>
