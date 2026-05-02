@extends('layouts.admin')
@section('header_title', 'Kelola Projects')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-display font-semibold text-white">Daftar Project</h2>
    <a href="{{ route('admin.projects.create') }}" class="btn-primary">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        <span>Tambah Project</span>
    </a>
</div>

<div class="admin-card overflow-hidden p-0">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white/5 border-b border-white/10 text-slate-400 text-sm">
                    <th class="p-4 font-medium">Project</th>
                    <th class="p-4 font-medium">Kategori</th>
                    <th class="p-4 font-medium">Status</th>
                    <th class="p-4 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($projects as $project)
                <tr class="hover:bg-white/5 transition-colors group">
                    <td class="p-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-12 rounded-lg bg-slate-800 shrink-0 overflow-hidden">
                                @if($project->thumbnail)
                                    <img src="{{ $project->thumbnail }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-medium text-slate-200">{{ $project->title }}</h3>
                                <div class="flex items-center gap-2 mt-1">
                                    @if($project->featured)
                                    <span class="px-1.5 py-0.5 rounded text-[10px] font-bold bg-blue-500/20 text-blue-400 border border-blue-500/20">Featured</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 text-sm text-slate-400">
                        <span class="badge badge-purple">{{ $project->category }}</span>
                    </td>
                    <td class="p-4 text-sm">
                        @if($project->is_active)
                        <span class="badge badge-green">Aktif</span>
                        @else
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-slate-500/20 text-slate-400 border border-slate-500/30">Draft</span>
                        @endif
                    </td>
                    <td class="p-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="p-2 text-slate-400 hover:text-[#36aaf8] hover:bg-white/5 rounded-lg transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus project ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-red-400 hover:bg-white/5 rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-slate-500">
                        Belum ada project. <a href="{{ route('admin.projects.create') }}" class="text-[#36aaf8] hover:underline">Tambah project pertama</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($projects->hasPages())
    <div class="p-4 border-t border-white/5">
        {{ $projects->links() }}
    </div>
    @endif
</div>
@endsection
