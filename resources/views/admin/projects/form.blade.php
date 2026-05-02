@extends('layouts.admin')
@section('header_title', isset($project) ? 'Edit Project' : 'Tambah Project')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.projects.index') }}" class="text-sm text-slate-400 hover:text-white flex items-center gap-2">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Project
    </a>
</div>

<div class="admin-card">
    <form action="{{ isset($project) ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($project))
            @method('PUT')
        @endif

        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div>
                    <label class="block text-slate-400 text-sm font-medium mb-2">Judul Project *</label>
                    <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}" required class="input-field">
                </div>

                <div>
                    <label class="block text-slate-400 text-sm font-medium mb-2">Deskripsi Singkat *</label>
                    <textarea name="description" rows="3" required class="input-field">{{ old('description', $project->description ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-slate-400 text-sm font-medium mb-2">Deskripsi Lengkap</label>
                    <textarea name="long_description" rows="8" class="input-field">{{ old('long_description', $project->long_description ?? '') }}</textarea>
                </div>

                <div class="grid sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">URL Demo</label>
                        <input type="url" name="demo_url" value="{{ old('demo_url', $project->demo_url ?? '') }}" class="input-field" placeholder="https://...">
                    </div>
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">URL Source Code (GitHub)</label>
                        <input type="url" name="github_url" value="{{ old('github_url', $project->github_url ?? '') }}" class="input-field" placeholder="https://github.com/...">
                    </div>
                </div>

                <div>
                    <label class="block text-slate-400 text-sm font-medium mb-2">Teknologi (pisahkan dengan koma)</label>
                    <input type="text" name="technologies" value="{{ old('technologies', isset($project) && $project->technologies ? implode(', ', $project->technologies) : '') }}" class="input-field" placeholder="Laravel, Vue.js, Tailwind">
                </div>
            </div>

            <div class="space-y-6">
                <div class="p-5 rounded-xl bg-white/5 border border-white/10 space-y-5">
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">Kategori *</label>
                        <select name="category" required class="input-field appearance-none">
                            <option value="web" {{ old('category', $project->category ?? '') == 'web' ? 'selected' : '' }}>Web Development</option>
                            <option value="api" {{ old('category', $project->category ?? '') == 'api' ? 'selected' : '' }}>API/Backend</option>
                            <option value="mobile" {{ old('category', $project->category ?? '') == 'mobile' ? 'selected' : '' }}>Mobile App</option>
                            <option value="design" {{ old('category', $project->category ?? '') == 'design' ? 'selected' : '' }}>UI/UX Design</option>
                            <option value="other" {{ old('category', $project->category ?? '') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">Urutan Tampil (Order)</label>
                        <input type="number" name="order" value="{{ old('order', $project->order ?? 0) }}" class="input-field">
                        <p class="text-xs text-slate-500 mt-1">Angka lebih kecil tampil lebih dulu</p>
                    </div>

                    <div class="space-y-3 pt-3 border-t border-white/10">
                        <label class="flex items-center cursor-pointer">
                            <input type="hidden" name="featured" value="0">
                            <input type="checkbox" name="featured" value="1" {{ old('featured', $project->featured ?? false) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-9 h-5 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#0c90e9]"></div>
                            <span class="ml-3 text-sm font-medium text-slate-300">Tandai sebagai Featured</span>
                        </label>

                        <label class="flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active ?? true) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-9 h-5 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#0c90e9]"></div>
                            <span class="ml-3 text-sm font-medium text-slate-300">Publish Project (Aktif)</span>
                        </label>
                    </div>
                </div>

                <div class="p-5 rounded-xl bg-white/5 border border-white/10">
                    <label class="block text-slate-400 text-sm font-medium mb-3">Gambar Thumbnail</label>
                    
                    @if(isset($project) && $project->thumbnail)
                    <div class="mb-4 rounded-lg overflow-hidden border border-white/10 relative group">
                        <img src="{{ $project->thumbnail }}" class="w-full aspect-video object-cover">
                    </div>
                    @endif

                    <input type="file" name="thumbnail" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#0c90e9] file:text-white hover:file:bg-[#0159a1]">
                </div>

                <button type="submit" class="btn-primary w-full justify-center mt-6">
                    <span>{{ isset($project) ? 'Simpan Perubahan' : 'Tambah Project' }}</span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
