@extends('layouts.admin')
@section('header_title', 'Kelola Pengalaman')

@section('content')
<div x-data="{ showModal: false, editMode: false, currentExp: null }">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-display font-semibold text-white">Daftar Pengalaman</h2>
        <button @click="showModal = true; editMode = false; currentExp = null; $refs.form.reset()" class="btn-primary">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Tambah Pengalaman</span>
        </button>
    </div>

    <div class="space-y-4">
        @forelse($experiences as $exp)
        <div class="admin-card p-5 group flex items-start justify-between gap-4">
            <div>
                <div class="flex items-center gap-3 mb-1">
                    <h3 class="font-medium text-white text-lg">{{ $exp->position }}</h3>
                    @if($exp->is_current)
                    <span class="px-2 py-0.5 rounded text-xs font-medium bg-emerald-500/20 text-emerald-400 border border-emerald-500/20">Sekarang</span>
                    @endif
                </div>
                <div class="text-[#36aaf8] font-medium mb-3">{{ $exp->company }}</div>
                
                <div class="flex items-center gap-4 text-sm text-slate-400 mb-3">
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $exp->start_date->format('M Y') }} — {{ $exp->is_current ? 'Sekarang' : ($exp->end_date ? $exp->end_date->format('M Y') : '-') }}
                    </div>
                    @if($exp->location)
                    <div class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $exp->location }}
                    </div>
                    @endif
                </div>
                
                <p class="text-slate-400 text-sm max-w-3xl">{{ $exp->description }}</p>
            </div>
            
            <div class="flex items-center gap-2">
                <button @click='showModal = true; editMode = true; currentExp = @json($exp)' class="p-2 text-slate-400 hover:text-[#36aaf8] hover:bg-white/5 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                </button>
                <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pengalaman ini?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="p-2 text-slate-400 hover:text-red-400 hover:bg-white/5 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="admin-card text-center py-12 text-slate-500">
            Belum ada pengalaman ditambahkan.
        </div>
        @endforelse
    </div>

    <!-- Modal Form -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div @click.away="showModal = false" class="bg-[#0f172a] border border-white/10 rounded-2xl w-full max-w-2xl overflow-hidden shadow-2xl max-h-[90vh] flex flex-col">
            <div class="px-6 py-4 border-b border-white/10 flex justify-between items-center shrink-0">
                <h3 class="font-medium text-white" x-text="editMode ? 'Edit Pengalaman' : 'Tambah Pengalaman'"></h3>
                <button @click="showModal = false" class="text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            
            <div class="flex-1 overflow-y-auto p-6">
                <form x-ref="form" :action="editMode ? '/admin/experiences/' + currentExp.id : '{{ route('admin.experiences.store') }}'" method="POST" class="space-y-4">
                    @csrf
                    <template x-if="editMode">
                        <input type="hidden" name="_method" value="PUT">
                    </template>
                    
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-slate-400 text-sm font-medium mb-1">Posisi / Jabatan *</label>
                            <input type="text" name="position" :value="currentExp ? currentExp.position : ''" required class="input-field py-2">
                        </div>
                        <div>
                            <label class="block text-slate-400 text-sm font-medium mb-1">Nama Perusahaan *</label>
                            <input type="text" name="company" :value="currentExp ? currentExp.company : ''" required class="input-field py-2">
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-slate-400 text-sm font-medium mb-1">Tanggal Mulai *</label>
                            <input type="date" name="start_date" :value="currentExp ? currentExp.start_date.substring(0,10) : ''" required class="input-field py-2">
                        </div>
                        <div x-data="{ isCurrent: false }" x-init="isCurrent = currentExp ? currentExp.is_current : false">
                            <label class="block text-slate-400 text-sm font-medium mb-1">Tanggal Selesai</label>
                            <input type="date" name="end_date" :value="currentExp && currentExp.end_date ? currentExp.end_date.substring(0,10) : ''" :disabled="isCurrent" class="input-field py-2 disabled:opacity-50">
                            
                            <label class="flex items-center cursor-pointer mt-2">
                                <input type="hidden" name="is_current" value="0">
                                <input type="checkbox" name="is_current" value="1" x-model="isCurrent" class="sr-only peer">
                                <div class="w-8 h-4 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-[#0c90e9]"></div>
                                <span class="ml-2 text-xs font-medium text-slate-400">Masih bekerja di sini</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-1">Lokasi (Opsional)</label>
                        <input type="text" name="location" :value="currentExp ? currentExp.location : ''" class="input-field py-2" placeholder="Jakarta, Indonesia">
                    </div>

                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-1">Deskripsi Singkat</label>
                        <textarea name="description" rows="3" class="input-field py-2" x-text="currentExp ? currentExp.description : ''"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-1">Tanggung Jawab (Pisahkan dengan baris baru)</label>
                        <textarea name="responsibilities" rows="4" class="input-field py-2" x-text="currentExp && currentExp.responsibilities ? currentExp.responsibilities.join('\n') : ''"></textarea>
                    </div>

                    <div class="pt-4 flex justify-end gap-3 border-t border-white/5 mt-6">
                        <button type="button" @click="showModal = false" class="btn-outline py-2 px-4 text-sm">Batal</button>
                        <button type="submit" class="btn-primary py-2 px-6 text-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
