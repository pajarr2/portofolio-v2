@extends('layouts.admin')
@section('header_title', 'Pesan Kontak')

@section('content')
<div class="admin-card overflow-hidden p-0">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white/5 border-b border-white/10 text-slate-400 text-sm">
                    <th class="p-4 font-medium">Pengirim</th>
                    <th class="p-4 font-medium">Subjek & Pesan</th>
                    <th class="p-4 font-medium">Tanggal</th>
                    <th class="p-4 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($contacts as $contact)
                <tr class="hover:bg-white/5 transition-colors {{ !$contact->is_read ? 'bg-blue-500/5' : '' }}">
                    <td class="p-4">
                        <div class="font-medium text-slate-200">{{ $contact->name }}</div>
                        <div class="text-sm text-slate-500">{{ $contact->email }}</div>
                    </td>
                    <td class="p-4 max-w-md">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="font-medium text-slate-300 truncate">{{ $contact->subject ?? 'Tanpa Subjek' }}</span>
                            @if(!$contact->is_read)
                            <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-rose-500/20 text-rose-400 border border-rose-500/20 uppercase">Baru</span>
                            @endif
                        </div>
                        <p class="text-sm text-slate-500 truncate">{{ Str::limit($contact->message, 60) }}</p>
                    </td>
                    <td class="p-4 text-sm text-slate-400 whitespace-nowrap">
                        {{ $contact->created_at->format('d M Y, H:i') }}
                    </td>
                    <td class="p-4">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.contacts.show', $contact) }}" class="p-2 text-slate-400 hover:text-[#36aaf8] hover:bg-white/5 rounded-lg transition-colors" title="Baca Pesan">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-400 hover:bg-white/5 rounded-lg transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-slate-500">Tidak ada pesan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($contacts->hasPages())
    <div class="p-4 border-t border-white/5">
        {{ $contacts->links() }}
    </div>
    @endif
</div>
@endsection
