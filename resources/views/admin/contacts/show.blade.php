@extends('layouts.admin')
@section('header_title', 'Detail Pesan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.contacts.index') }}" class="text-sm text-slate-400 hover:text-white flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Kotak Masuk
    </a>
</div>

<div class="admin-card max-w-3xl">
    <div class="flex items-start justify-between gap-4 mb-8 border-b border-white/10 pb-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-slate-800 border border-white/10 flex items-center justify-center text-lg font-bold text-slate-300 uppercase">
                {{ substr($contact->name, 0, 1) }}
            </div>
            <div>
                <h2 class="text-xl font-medium text-white">{{ $contact->name }}</h2>
                <a href="mailto:{{ $contact->email }}" class="text-sm text-[#36aaf8] hover:underline">{{ $contact->email }}</a>
            </div>
        </div>
        <div class="text-right">
            <div class="text-sm text-slate-400">{{ $contact->created_at->format('d M Y, H:i') }}</div>
            <div class="text-xs text-slate-500 mt-1">{{ $contact->created_at->diffForHumans() }}</div>
        </div>
    </div>

    <div class="mb-8">
        <h3 class="text-lg font-medium text-slate-200 mb-4 border-l-2 border-[#0c90e9] pl-3 py-0.5">
            {{ $contact->subject ?? '(Tanpa Subjek)' }}
        </h3>
        <div class="p-5 rounded-xl bg-white/5 border border-white/5 text-slate-300 leading-relaxed whitespace-pre-line">
            {{ $contact->message }}
        </div>
    </div>

    <div class="flex items-center gap-4 pt-6 border-t border-white/10">
        <a href="mailto:{{ $contact->email }}" class="btn-primary">
            <svg class="w-4 h-4 shrink-0 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            <span class="relative z-10">Balas Email</span>
        </a>
        
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn-outline text-red-400 border-red-500/50 hover:bg-red-500/10 hover:border-red-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Hapus
            </button>
        </form>
    </div>
</div>
@endsection
