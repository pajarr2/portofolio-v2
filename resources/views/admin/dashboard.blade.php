@extends('layouts.admin')
@section('header_title', 'Dashboard Overview')

@section('content')
<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="admin-card flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
        </div>
        <div>
            <p class="text-slate-500 text-sm font-medium">Total Projects</p>
            <p class="text-2xl font-display font-bold text-white">{{ $stats['projects'] }}</p>
        </div>
    </div>
    
    <div class="admin-card flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
        <div>
            <p class="text-slate-500 text-sm font-medium">Total Skills</p>
            <p class="text-2xl font-display font-bold text-white">{{ $stats['skills'] }}</p>
        </div>
    </div>

    <div class="admin-card flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center shrink-0">
            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <div>
            <p class="text-slate-500 text-sm font-medium">Pengalaman</p>
            <p class="text-2xl font-display font-bold text-white">{{ $stats['experiences'] }}</p>
        </div>
    </div>

    <div class="admin-card flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-rose-500/10 border border-rose-500/20 flex items-center justify-center shrink-0 relative">
            @if($stats['unread'] > 0)
            <span class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-rose-500 animate-pulse"></span>
            @endif
            <svg class="w-6 h-6 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <div>
            <p class="text-slate-500 text-sm font-medium">Pesan Masuk</p>
            <p class="text-2xl font-display font-bold text-white">{{ $stats['contacts'] }} <span class="text-sm font-normal text-slate-500">({{ $stats['unread'] }} baru)</span></p>
        </div>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6">
    <!-- Recent Contacts -->
    <div class="admin-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-white font-display">Pesan Terbaru</h2>
            <a href="{{ route('admin.contacts.index') }}" class="text-sm text-[#36aaf8] hover:text-[#0c90e9]">Lihat Semua</a>
        </div>
        
        <div class="space-y-4">
            @forelse($recentContacts as $contact)
            <a href="{{ route('admin.contacts.show', $contact) }}" class="block p-4 rounded-xl bg-white/5 border border-white/5 hover:border-[#0c90e9]/30 transition-colors">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-medium text-slate-200 truncate">{{ $contact->name }}</span>
                            @if(!$contact->is_read)
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-500/20 text-rose-400 border border-rose-500/20 uppercase tracking-wider">Baru</span>
                            @endif
                        </div>
                        <p class="text-sm text-slate-400 truncate">{{ $contact->subject ?? 'Tanpa Subject' }}</p>
                    </div>
                    <span class="text-xs text-slate-500 whitespace-nowrap">{{ $contact->created_at->diffForHumans() }}</span>
                </div>
            </a>
            @empty
            <div class="text-center py-8 text-slate-500">Belum ada pesan masuk.</div>
            @endforelse
        </div>
    </div>

    <!-- Featured Projects -->
    <div class="admin-card">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-white font-display">Project Unggulan</h2>
            <a href="{{ route('admin.projects.index') }}" class="text-sm text-[#36aaf8] hover:text-[#0c90e9]">Kelola</a>
        </div>
        
        <div class="space-y-4">
            @forelse($featuredProjects as $project)
            <div class="flex items-center gap-4 p-3 rounded-xl bg-white/5 border border-white/5">
                <div class="w-16 h-12 rounded-lg bg-slate-800 shrink-0 overflow-hidden">
                    @if($project->thumbnail)
                        <img src="{{ $project->thumbnail }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="font-medium text-slate-200 truncate">{{ $project->title }}</h3>
                    <p class="text-xs text-slate-500 truncate">{{ $project->category }}</p>
                </div>
                <a href="{{ route('admin.projects.edit', $project) }}" class="p-2 text-slate-400 hover:text-white rounded-lg hover:bg-white/10 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                </a>
            </div>
            @empty
            <div class="text-center py-8 text-slate-500">Belum ada project unggulan.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
