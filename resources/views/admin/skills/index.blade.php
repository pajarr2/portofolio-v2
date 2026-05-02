@extends('layouts.admin')
@section('header_title', 'Kelola Skills')

@section('content')
<div x-data="{ showModal: false, editMode: false, currentSkill: null }">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-display font-semibold text-white">Daftar Skills</h2>
        <button @click="showModal = true; editMode = false; currentSkill = null; $refs.form.reset()" class="btn-primary">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Tambah Skill</span>
        </button>
    </div>

    <div class="space-y-8">
        @forelse($skills as $category => $categorySkills)
        <div class="admin-card p-0 overflow-hidden">
            <div class="px-6 py-4 border-b border-white/5 bg-white/[0.02]">
                <h3 class="font-medium text-white capitalize">{{ $category }}</h3>
            </div>
            <div class="p-6 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($categorySkills as $skill)
                <div class="p-4 rounded-xl bg-white/5 border border-white/5 hover:border-white/10 transition-colors relative group">
                    <div class="flex items-start justify-between mb-3">
                        <div class="font-medium text-slate-200">{{ $skill->name }}</div>
                        <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <button @click='showModal = true; editMode = true; currentSkill = @json($skill)' class="text-slate-400 hover:text-[#36aaf8]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </button>
                            <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Hapus skill ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-red-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex-1 h-1.5 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full rounded-full" style="width: {{ $skill->level }}%; background-color: {{ $skill->color ?? '#0c90e9' }}"></div>
                        </div>
                        <span class="text-xs text-slate-400 font-medium w-8">{{ $skill->level }}%</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div class="admin-card text-center py-12 text-slate-500">
            Belum ada skill ditambahkan.
        </div>
        @endforelse
    </div>

    <!-- Modal Form -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">
        <div @click.away="showModal = false" class="bg-[#0f172a] border border-white/10 rounded-2xl w-full max-w-md overflow-hidden shadow-2xl">
            <div class="px-6 py-4 border-b border-white/10 flex justify-between items-center">
                <h3 class="font-medium text-white" x-text="editMode ? 'Edit Skill' : 'Tambah Skill'"></h3>
                <button @click="showModal = false" class="text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form x-ref="form" :action="editMode ? '/admin/skills/' + currentSkill.id : '{{ route('admin.skills.store') }}'" method="POST" class="p-6 space-y-4">
                @csrf
                <template x-if="editMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>
                
                <div>
                    <label class="block text-slate-400 text-sm font-medium mb-1">Nama Skill</label>
                    <input type="text" name="name" :value="currentSkill ? currentSkill.name : ''" required class="input-field py-2">
                </div>
                <div>
                    <label class="block text-slate-400 text-sm font-medium mb-1">Level (0-100)</label>
                    <input type="number" name="level" :value="currentSkill ? currentSkill.level : 80" min="0" max="100" required class="input-field py-2">
                </div>
                <div>
                    <label class="block text-slate-400 text-sm font-medium mb-1">Kategori</label>
                    <select name="category" class="input-field py-2 appearance-none" required>
                        <option value="frontend" :selected="currentSkill && currentSkill.category == 'frontend'">Frontend</option>
                        <option value="backend" :selected="currentSkill && currentSkill.category == 'backend'">Backend</option>
                        <option value="tools" :selected="currentSkill && currentSkill.category == 'tools'">Tools / DevOps</option>
                        <option value="design" :selected="currentSkill && currentSkill.category == 'design'">UI/UX Design</option>
                        <option value="other" :selected="currentSkill && currentSkill.category == 'other'">Lainnya</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-1">Warna Hex</label>
                        <input type="text" name="color" :value="currentSkill ? currentSkill.color : '#0c90e9'" class="input-field py-2" placeholder="#0c90e9">
                    </div>
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-1">Urutan</label>
                        <input type="number" name="order" :value="currentSkill ? currentSkill.order : 0" class="input-field py-2">
                    </div>
                </div>
                
                <div class="pt-4 flex justify-end gap-3 border-t border-white/5 mt-6">
                    <button type="button" @click="showModal = false" class="btn-outline py-2 px-4 text-sm">Batal</button>
                    <button type="submit" class="btn-primary py-2 px-6 text-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
