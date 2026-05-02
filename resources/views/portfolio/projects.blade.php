@extends('layouts.portfolio')
@section('title', 'Projects')

@section('content')
<section class="pt-32 pb-24">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Header -->
        <div class="text-center mb-16 fade-in">
            <div class="section-label justify-center">Portfolio</div>
            <h1 class="font-display font-extrabold text-4xl md:text-5xl text-white mt-3">Semua Projects</h1>
            <p class="text-slate-500 mt-4 max-w-xl mx-auto text-lg">Koleksi lengkap proyek yang telah saya kerjakan</p>
        </div>

        <!-- Projects Grid -->
        @if($projects->isEmpty())
        {{-- Beautiful empty state --}}
        <div class="flex flex-col items-center justify-center py-24 fade-in">
            <div class="w-24 h-24 rounded-3xl flex items-center justify-center mb-6"
                 style="background: linear-gradient(135deg, rgba(12,144,233,0.15), rgba(1,89,161,0.1)); border: 1px solid rgba(12,144,233,0.25);">
                <svg class="w-12 h-12 text-[#36aaf8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2"
                          d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                </svg>
            </div>
            <h2 class="font-display font-bold text-2xl text-white mb-2">Belum Ada Project</h2>
            <p class="text-slate-500 text-center max-w-sm mb-8">
                Proyek akan muncul di sini setelah ditambahkan melalui admin panel.
            </p>
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('portfolio.index') }}" class="btn-outline text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                    </svg>
                    Kembali ke Home
                </a>
                <a href="{{ route('portfolio.contact') }}" class="btn-primary text-sm">
                    <span>Hubungi Saya</span>
                    <svg class="w-4 h-4 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
        @else
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
            <a href="{{ route('portfolio.project.show', $project->slug) }}"
               class="project-card glass-card overflow-hidden group block fade-in">
                <div class="relative h-48 overflow-hidden" style="background: linear-gradient(135deg, #08101e, #0a1828);">
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
                    <div class="project-overlay absolute inset-0 flex items-center justify-center" style="background: rgba(8,16,30,0.8);">
                        <span class="btn-primary text-sm py-2 px-4"><span>Lihat Detail</span></span>
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

        <!-- Pagination -->
        @if($projects->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $projects->links() }}
        </div>
        @endif
        @endif
    </div>
</section>
@endsection
