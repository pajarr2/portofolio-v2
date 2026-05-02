@extends('layouts.portfolio')
@section('title', 'Home')

@section('content')

{{-- ═══════════════════════════════════════════ HERO ═══════ --}}
<section class="relative min-h-screen flex items-center pt-20">
    <div class="max-w-6xl mx-auto px-6 w-full py-20">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-8">
                <!-- Status badge -->
                @if($settings['open_to_work'] ?? false)
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-medium text-emerald-400 fade-in"
                     style="background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.2);">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Tersedia untuk proyek baru
                </div>
                @endif

                <!-- Name & tagline -->
                <div class="fade-in space-y-4">
                    <p class="text-[#36aaf8] font-semibold text-lg tracking-wide">Halo, saya</p>
                    <h1 class="font-display font-extrabold leading-tight" style="font-size: clamp(2.5rem, 6vw, 4.5rem);">
                        <span class="text-white">{{ $settings['name'] ?? 'Your Name' }}</span>
                    </h1>
                    <p class="gradient-text font-display font-bold text-2xl md:text-3xl">
                        {{ $settings['tagline'] ?? 'Full Stack Developer' }}
                    </p>
                </div>

                <p class="text-slate-400 text-lg leading-relaxed max-w-xl fade-in">
                    {{ $settings['hero_subtitle'] ?? 'Membangun solusi digital yang elegan & berdampak' }}
                </p>

                <p class="text-slate-500 leading-relaxed max-w-lg fade-in">
                    {{ $settings['bio'] ?? '' }}
                </p>

                <!-- CTA buttons -->
                <div class="flex flex-wrap gap-4 fade-in">
                    <a href="{{ route('portfolio.projects') }}" class="btn-primary">
                        <span>Lihat Projects</span>
                        <svg class="w-4 h-4 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    @if($settings['cv_url'] ?? false)
                    <a href="{{ $settings['cv_url'] }}" target="_blank" class="btn-outline">
                        Download CV
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                    </a>
                    @endif
                </div>

                <!-- Social links -->
                <div class="flex items-center gap-4 fade-in">
                    <span class="text-slate-600 text-sm">Follow me:</span>
                    @foreach($socials as $social)
                    <a href="{{ $social->url }}" target="_blank"
                       class="w-9 h-9 rounded-lg flex items-center justify-center text-slate-500 hover:text-[#36aaf8] transition-all hover:scale-110 hover:-translate-y-1"
                       style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06);">
                        @include('partials.social-icon', ['platform' => $social->icon])
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Hero Visual -->
            <div class="relative flex justify-center lg:justify-end fade-in">
                <div class="relative mx-16">
                    <!-- Glow rings -->
                    <div class="absolute inset-0 rounded-full opacity-20 pointer-events-none"
                         style="background: radial-gradient(circle, #0c90e9, transparent 70%); width: 400px; height: 400px; left: 50%; top: 50%; transform: translate(-50%,-50%); filter: blur(40px);"></div>

                    <!-- Avatar/Photo frame -->
                    <div class="relative w-64 h-64 lg:w-72 lg:h-72 rounded-3xl overflow-hidden float-animate pulse-glow"
                         style="background: linear-gradient(135deg, rgba(12,144,233,0.2), rgba(1,89,161,0.2)); border: 2px solid rgba(12,144,233,0.3);">
                        @if($settings['avatar'] ?? false)
                            <img src="{{ $settings['avatar'] }}" alt="{{ $settings['name'] }}" class="w-full h-full object-cover">
                        @else
                            <div class="absolute inset-0 flex flex-col items-center justify-center"
                                 style="background: linear-gradient(135deg, #08101e, #0a1828);">
                                <div class="w-24 h-24 rounded-full flex items-center justify-center mb-3"
                                     style="background: linear-gradient(135deg, #0c90e9, #0159a1);">
                                    <span class="text-white font-display font-bold text-4xl">
                                        {{ strtoupper(substr($settings['name'] ?? 'D', 0, 1)) }}
                                    </span>
                                </div>
                                <p class="text-slate-500 text-sm">Upload foto di Settings</p>
                            </div>
                        @endif
                    </div>

                    <!-- Code snippet: di luar overflow-hidden, pojok kanan bawah -->
                    <div class="absolute -bottom-5 -right-14 glass-card p-3 text-xs font-mono text-[#36aaf8] z-10 shadow-lg"
                         style="max-width: 158px;">
                        <div class="text-slate-500 mb-1">// status.json</div>
                        <div><span class="text-purple-400">"available"</span>: <span class="text-emerald-400">true</span></div>
                        <div><span class="text-purple-400">"passion"</span>: <span class="text-[#36aaf8]">100%</span></div>
                    </div>

                    <!-- Floating stat card kiri -->
                    <div class="absolute -left-24 top-1/4 glass-card px-4 py-3 text-center float-animate"
                         style="animation-delay: 1s; min-width: 108px;">
                        <p class="gradient-text font-bold text-2xl font-display leading-none mb-1">{{ $settings['years_exp'] ?? '4+' }}</p>
                        <p class="text-slate-500 text-xs">Tahun Pengalaman</p>
                    </div>

                    <!-- Floating stat card kanan -->
                    <div class="absolute -right-24 bottom-1/4 glass-card px-4 py-3 text-center float-animate"
                         style="animation-delay: 2s; min-width: 108px;">
                        <p class="gradient-text font-bold text-2xl font-display leading-none mb-1">{{ $settings['projects_done'] ?? '50+' }}</p>
                        <p class="text-slate-500 text-xs">Project Selesai</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-50">
            <span class="text-slate-600 text-xs tracking-widest uppercase">Scroll</span>
            <div class="w-px h-12 bg-gradient-to-b from-[#0c90e9] to-transparent"></div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════ ABOUT ═══════ --}}
<section id="about" class="py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Stats -->
            <div class="grid grid-cols-3 gap-4 fade-in">
                @foreach([
                    ['value' => $settings['years_exp'] ?? '4+', 'label' => 'Tahun Pengalaman', 'icon' => 'clock'],
                    ['value' => $settings['projects_done'] ?? '50+', 'label' => 'Project Selesai', 'icon' => 'folder'],
                    ['value' => $settings['clients'] ?? '20+', 'label' => 'Klien Puas', 'icon' => 'users'],
                ] as $stat)
                <div class="glass-card p-6 text-center hover:scale-105 transition-transform">
                    <p class="gradient-text font-display font-extrabold text-3xl mb-1">{{ $stat['value'] }}</p>
                    <p class="text-slate-500 text-sm">{{ $stat['label'] }}</p>
                </div>
                @endforeach

                <!-- Tech stack showcase -->
                <div class="col-span-3 glass-card p-5 mt-2">
                    <p class="text-slate-500 text-xs uppercase tracking-widest mb-3">Tech Stack Utama</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Laravel', 'Vue.js', 'React', 'Tailwind', 'MySQL', 'Docker', 'AWS'] as $tech)
                        <span class="badge badge-blue">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Text -->
            <div class="space-y-6 fade-in">
                <div class="section-label">Tentang Saya</div>
                <h2 class="font-display font-bold text-3xl md:text-4xl text-white">
                    {{ $settings['about_title'] ?? 'Siapa Saya?' }}
                </h2>
                <p class="text-slate-400 leading-relaxed text-lg">
                    {{ $settings['bio'] ?? '' }}
                </p>
                <p class="text-slate-500 leading-relaxed">
                    {{ $settings['about_text'] ?? '' }}
                </p>

                <div class="flex flex-wrap gap-6 pt-4">
                    @if($settings['email'] ?? false)
                    <div class="flex items-center gap-3 text-sm">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: rgba(12,144,233,0.1);">
                            <svg class="w-4 h-4 text-[#36aaf8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-slate-400">{{ $settings['email'] }}</span>
                    </div>
                    @endif
                    @if($settings['location'] ?? false)
                    <div class="flex items-center gap-3 text-sm">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background: rgba(12,144,233,0.1);">
                            <svg class="w-4 h-4 text-[#36aaf8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <span class="text-slate-400">{{ $settings['location'] }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════ SERVICES ═══ --}}
@if($services->isNotEmpty())
<section id="services" class="py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16 fade-in">
            <div class="section-label justify-center">Yang Saya Lakukan</div>
            <h2 class="font-display font-bold text-3xl md:text-4xl text-white mt-3">Layanan</h2>
            <p class="text-slate-500 mt-4 max-w-lg mx-auto">Solusi digital komprehensif untuk kebutuhan bisnis Anda</p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($services as $service)
            <div class="glass-card-light p-6 group hover:scale-105 transition-all duration-300 fade-in"
                 style="border-color: rgba({{ hexdec(substr($service->color,1,2)) }},{{ hexdec(substr($service->color,3,2)) }},{{ hexdec(substr($service->color,5,2)) }}, 0.15);">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110"
                     style="background: {{ $service->color }}22;">
                    @include('partials.service-icon', ['icon' => $service->icon, 'color' => $service->color])
                </div>
                <h3 class="font-semibold text-white mb-2 font-display">{{ $service->title }}</h3>
                <p class="text-slate-500 text-sm leading-relaxed">{{ $service->description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════ SKILLS ═══════ --}}
@if($skills->isNotEmpty())
<section id="skills" class="py-24 skills-section">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16 fade-in">
            <div class="section-label justify-center">Kemampuan</div>
            <h2 class="font-display font-bold text-3xl md:text-4xl text-white mt-3">Tech Stack & Skills</h2>
            <p class="text-slate-500 mt-4 max-w-lg mx-auto">Teknologi yang saya kuasai untuk membangun solusi digital</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            @foreach($skills as $category => $categorySkills)
            <div class="glass-card p-6 fade-in">
                <h3 class="text-white font-semibold mb-6 font-display flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#0c90e9]"></span>
                    {{ ucfirst($category) }}
                </h3>
                <div class="space-y-5">
                    @foreach($categorySkills as $skill)
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-slate-300 text-sm font-medium">{{ $skill->name }}</span>
                            <span class="text-[#36aaf8] text-xs font-bold">{{ $skill->level }}%</span>
                        </div>
                        <div class="skill-bar-track">
                            <div class="skill-bar-fill" data-width="{{ $skill->level }}%" style="width: 0%; background: linear-gradient(90deg, {{ $skill->color ?? '#0c90e9' }}, {{ $skill->color ?? '#36aaf8' }});"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════ PROJECTS ═══ --}}
@if($projects->isNotEmpty())
<section id="projects" class="py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-16 gap-4 fade-in">
            <div>
                <div class="section-label">Portfolio</div>
                <h2 class="font-display font-bold text-3xl md:text-4xl text-white mt-3">Project Unggulan</h2>
            </div>
            <a href="{{ route('portfolio.projects') }}" class="btn-outline text-sm">
                Lihat Semua
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
            <a href="{{ route('portfolio.project.show', $project->slug) }}"
               class="project-card glass-card overflow-hidden group block fade-in">
                <!-- Thumbnail -->
                <div class="relative h-48 overflow-hidden"
                     style="background: linear-gradient(135deg, #08101e, #0a1828);">
                    @if($project->thumbnail)
                        <img src="{{ $project->thumbnail }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <div class="w-16 h-16 rounded-2xl mx-auto mb-3 flex items-center justify-center"
                                     style="background: linear-gradient(135deg, rgba(12,144,233,0.2), rgba(1,89,161,0.2)); border: 1px solid rgba(12,144,233,0.2);">
                                    <svg class="w-8 h-8 text-[#36aaf8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                    </svg>
                                </div>
                                <p class="text-slate-600 text-xs">{{ $project->category }}</p>
                            </div>
                        </div>
                    @endif
                    <!-- Overlay on hover -->
                    <div class="project-overlay absolute inset-0 flex items-center justify-center"
                         style="background: rgba(8,16,30,0.8);">
                        <span class="btn-primary text-sm py-2 px-4">
                            <span>Lihat Detail</span>
                        </span>
                    </div>
                    @if($project->featured)
                    <div class="absolute top-3 right-3 badge badge-blue">Featured</div>
                    @endif
                </div>

                <div class="p-5">
                    <div class="flex items-start justify-between gap-2 mb-2">
                        <h3 class="font-semibold text-white font-display group-hover:text-[#36aaf8] transition-colors">{{ $project->title }}</h3>
                        <span class="badge badge-purple shrink-0">{{ $project->category }}</span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed mb-4 line-clamp-2">{{ $project->description }}</p>

                    @if($project->technologies)
                    <div class="flex flex-wrap gap-1.5">
                        @foreach(array_slice($project->technologies, 0, 4) as $tech)
                        <span class="px-2 py-0.5 rounded-md text-xs text-slate-400" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06);">{{ $tech }}</span>
                        @endforeach
                        @if(count($project->technologies) > 4)
                        <span class="px-2 py-0.5 rounded-md text-xs text-slate-500">+{{ count($project->technologies) - 4 }}</span>
                        @endif
                    </div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════ EXPERIENCE ═ --}}
@if($experiences->isNotEmpty())
<section id="experience" class="py-24">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16">
            <!-- Work Experience -->
            <div class="fade-in">
                <div class="section-label">Karier</div>
                <h2 class="font-display font-bold text-3xl text-white mb-10">Pengalaman Kerja</h2>

                <div class="space-y-0">
                    @foreach($experiences as $experience)
                    <div class="flex gap-5">
                        {{-- Left: dot + line --}}
                        <div class="flex flex-col items-center shrink-0 pt-5">
                            <div class="w-3.5 h-3.5 rounded-full shrink-0 z-10"
                                 style="background: #0c90e9; border: 2px solid #36aaf8; box-shadow: 0 0 12px rgba(12,144,233,0.6);"></div>
                            @if(!$loop->last)
                            <div class="w-0.5 flex-1 mt-2" style="background: linear-gradient(to bottom, rgba(12,144,233,0.6), rgba(12,144,233,0.1));"></div>
                            @endif
                        </div>
                        {{-- Right: card --}}
                        <div class="flex-1 pb-8">
                            <div class="glass-card p-5 hover:border-[#0c90e9]/30 transition-colors">
                                <div class="flex flex-wrap items-start justify-between gap-2 mb-2">
                                    <div>
                                        <h3 class="font-semibold text-white font-display">{{ $experience->position }}</h3>
                                        <p class="text-[#36aaf8] text-sm font-medium">{{ $experience->company }}</p>
                                    </div>
                                    @if($experience->is_current)
                                    <span class="badge badge-green shrink-0">Current</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-3 text-slate-500 text-xs mb-3">
                                    <span>{{ $experience->duration }}</span>
                                    @if($experience->location)
                                    <span>·</span>
                                    <span>{{ $experience->location }}</span>
                                    @endif
                                </div>
                                @if($experience->description)
                                <p class="text-slate-500 text-sm">{{ $experience->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Education -->
            @if($educations->isNotEmpty())
            <div class="fade-in">
                <div class="section-label">Pendidikan</div>
                <h2 class="font-display font-bold text-3xl text-white mb-10">Riwayat Pendidikan</h2>

                <div class="space-y-0">
                    @foreach($educations as $edu)
                    <div class="flex gap-5">
                        {{-- Left: dot + line --}}
                        <div class="flex flex-col items-center shrink-0 pt-5">
                            <div class="w-3.5 h-3.5 rounded-full shrink-0 z-10"
                                 style="background: #8B5CF6; border: 2px solid #a78bfa; box-shadow: 0 0 12px rgba(139,92,246,0.6);"></div>
                            @if(!$loop->last)
                            <div class="w-0.5 flex-1 mt-2" style="background: linear-gradient(to bottom, rgba(139,92,246,0.4), rgba(139,92,246,0.05));"></div>
                            @endif
                        </div>
                        {{-- Right: card --}}
                        <div class="flex-1 pb-8">
                            <div class="glass-card p-5">
                                <h3 class="font-semibold text-white font-display">{{ $edu->institution }}</h3>
                                <p class="text-purple-400 text-sm font-medium mt-0.5">{{ $edu->degree }}{{ $edu->field_of_study ? ' — ' . $edu->field_of_study : '' }}</p>
                                <div class="flex items-center gap-3 text-slate-500 text-xs mt-2 mb-3">
                                    <span>{{ $edu->start_date->format('Y') }} — {{ $edu->is_current ? 'Sekarang' : ($edu->end_date ? $edu->end_date->format('Y') : '-') }}</span>
                                    @if($edu->location)
                                    <span>·</span><span>{{ $edu->location }}</span>
                                    @endif
                                </div>
                                @if($edu->description)
                                <p class="text-slate-500 text-sm">{{ $edu->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════ CTA ═══════════ --}}
<section class="py-24">
    <div class="max-w-4xl mx-auto px-6">
        <div class="relative overflow-hidden rounded-3xl p-12 text-center fade-in"
             style="background: linear-gradient(135deg, rgba(12,144,233,0.15), rgba(1,89,161,0.1)); border: 1px solid rgba(12,144,233,0.2);">
            <div class="absolute inset-0 dot-grid opacity-30"></div>
            <div class="relative z-10">
                <h2 class="font-display font-extrabold text-3xl md:text-4xl text-white mb-4">
                    Punya Project Menarik?
                </h2>
                <p class="text-slate-400 text-lg mb-8 max-w-xl mx-auto">
                    Mari berkolaborasi dan wujudkan ide Anda menjadi produk digital yang luar biasa!
                </p>
                <a href="{{ route('portfolio.contact') }}" class="btn-primary text-base py-3 px-8 inline-flex">
                    <span>Mulai Diskusi</span>
                    <svg class="w-5 h-5 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
