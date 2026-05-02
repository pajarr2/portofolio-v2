@extends('layouts.portfolio')
@section('title', $project->title)

@section('content')
<section class="pt-32 pb-24">
    <div class="max-w-5xl mx-auto px-6">
        <!-- Back button -->
        <a href="{{ route('portfolio.projects') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-[#36aaf8] transition-colors text-sm mb-10 group">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Projects
        </a>

        <div class="grid lg:grid-cols-3 gap-10">
            <!-- Main content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Thumbnail -->
                <div class="rounded-2xl overflow-hidden aspect-video" style="background: linear-gradient(135deg, #08101e, #0a1828); border: 1px solid rgba(12,144,233,0.15);">
                    @if($project->thumbnail)
                        <img src="{{ $project->thumbnail }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <div class="w-20 h-20 rounded-2xl flex items-center justify-center"
                                 style="background: linear-gradient(135deg, rgba(12,144,233,0.2), rgba(1,89,161,0.2)); border: 1px solid rgba(12,144,233,0.2);">
                                <svg class="w-10 h-10 text-[#36aaf8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                </svg>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Title & Meta -->
                <div>
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        <span class="badge badge-purple">{{ $project->category }}</span>
                        @if($project->featured)
                        <span class="badge badge-blue">Featured</span>
                        @endif
                    </div>
                    <h1 class="font-display font-extrabold text-3xl md:text-4xl text-white mb-4">{{ $project->title }}</h1>
                    <p class="text-slate-400 text-lg leading-relaxed">{{ $project->description }}</p>
                </div>

                @if($project->long_description)
                <div class="glass-card p-6">
                    <h2 class="font-semibold text-white font-display mb-4">Detail Project</h2>
                    <p class="text-slate-400 leading-relaxed whitespace-pre-line">{{ $project->long_description }}</p>
                </div>
                @endif

                <!-- Technologies -->
                @if($project->technologies)
                <div class="glass-card p-6">
                    <h2 class="font-semibold text-white font-display mb-4">Teknologi yang Digunakan</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->technologies as $tech)
                        <span class="badge badge-blue text-sm py-1.5 px-3">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-5">
                <!-- Links -->
                <div class="glass-card p-5 space-y-3">
                    <h3 class="font-semibold text-white font-display mb-4">Links</h3>
                    @if($project->demo_url)
                    <a href="{{ $project->demo_url }}" target="_blank" class="btn-primary w-full justify-center">
                        <svg class="w-4 h-4 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        <span>Live Demo</span>
                    </a>
                    @endif
                    @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" class="btn-outline w-full justify-center">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
                        </svg>
                        Source Code
                    </a>
                    @endif
                    @if(!$project->demo_url && !$project->github_url)
                    <p class="text-slate-600 text-sm text-center">Tidak ada link tersedia</p>
                    @endif
                </div>

                <!-- Contact CTA -->
                <div class="glass-card p-5 text-center" style="border-color: rgba(12,144,233,0.2);">
                    <p class="text-slate-400 text-sm mb-4">Tertarik project serupa?</p>
                    <a href="{{ route('portfolio.contact') }}" class="btn-primary w-full justify-center text-sm">
                        <span>Hubungi Saya</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Related Projects -->
        @if($related->isNotEmpty())
        <div class="mt-20">
            <h2 class="font-display font-bold text-2xl text-white mb-8">Project Lainnya</h2>
            <div class="grid sm:grid-cols-3 gap-5">
                @foreach($related as $rel)
                <a href="{{ route('portfolio.project.show', $rel->slug) }}" class="project-card glass-card overflow-hidden group">
                    <div class="h-36 flex items-center justify-center" style="background: linear-gradient(135deg, #08101e, #0a1828);">
                        @if($rel->thumbnail)
                            <img src="{{ $rel->thumbnail }}" alt="{{ $rel->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <svg class="w-8 h-8 text-[#36aaf8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                            </svg>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-white text-sm group-hover:text-[#36aaf8] transition-colors font-display">{{ $rel->title }}</h3>
                        <p class="text-slate-500 text-xs mt-1 line-clamp-2">{{ $rel->description }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
