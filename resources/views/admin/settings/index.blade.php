@extends('layouts.admin')
@section('header_title', 'Pengaturan Info Portfolio')

@section('content')
<div class="admin-card">
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="space-y-8">
            <!-- Hero Section -->
            <div>
                <h3 class="text-lg font-display font-semibold text-white mb-4 border-b border-white/10 pb-2">Bagian Hero</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $settings['name'] ?? '' }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">Tagline (Peran/Profesi)</label>
                        <input type="text" name="tagline" value="{{ $settings['tagline'] ?? '' }}" class="input-field">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-slate-400 text-sm font-medium mb-2">Subtitle Hero</label>
                        <input type="text" name="hero_subtitle" value="{{ $settings['hero_subtitle'] ?? '' }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">Foto Avatar (Kosongkan jika tidak ingin diubah)</label>
                        <input type="file" name="avatar" class="input-field file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#0c90e9] file:text-white hover:file:bg-[#0159a1]">
                        @if(!empty($settings['avatar']))
                        <div class="mt-2">
                            <img src="{{ $settings['avatar'] }}" class="w-16 h-16 rounded-lg object-cover">
                        </div>
                        @endif
                    </div>
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">Link/File CV</label>
                        <input type="text" name="cv_url" value="{{ $settings['cv_url'] ?? '' }}" class="input-field">
                    </div>
                    <div class="md:col-span-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="hidden" name="open_to_work" value="0">
                            <input type="checkbox" name="open_to_work" value="1" {{ ($settings['open_to_work'] ?? '0') == '1' ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0c90e9]"></div>
                            <span class="ml-3 text-sm font-medium text-slate-300">Tampilkan status "Open to Work"</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- About Section -->
            <div>
                <h3 class="text-lg font-display font-semibold text-white mb-4 border-b border-white/10 pb-2">Bagian Tentang Saya</h3>
                <div class="grid gap-6">
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">Judul Bagian</label>
                        <input type="text" name="about_title" value="{{ $settings['about_title'] ?? '' }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">Bio Singkat</label>
                        <textarea name="bio" rows="3" class="input-field">{{ $settings['bio'] ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">Deskripsi Lengkap</label>
                        <textarea name="about_text" rows="5" class="input-field">{{ $settings['about_text'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div>
                <h3 class="text-lg font-display font-semibold text-white mb-4 border-b border-white/10 pb-2">Statistik</h3>
                <div class="grid md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">Tahun Pengalaman</label>
                        <input type="text" name="years_exp" value="{{ $settings['years_exp'] ?? '' }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">Project Selesai</label>
                        <input type="text" name="projects_done" value="{{ $settings['projects_done'] ?? '' }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">Klien</label>
                        <input type="text" name="clients" value="{{ $settings['clients'] ?? '' }}" class="input-field">
                    </div>
                </div>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-lg font-display font-semibold text-white mb-4 border-b border-white/10 pb-2">Informasi Kontak</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">Email</label>
                        <input type="email" name="email" value="{{ $settings['email'] ?? '' }}" class="input-field">
                    </div>
                    <div>
                        <label class="block text-slate-400 text-sm font-medium mb-2">Telepon/WhatsApp</label>
                        <input type="text" name="phone" value="{{ $settings['phone'] ?? '' }}" class="input-field">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-slate-400 text-sm font-medium mb-2">Lokasi (Kota, Negara)</label>
                        <input type="text" name="location" value="{{ $settings['location'] ?? '' }}" class="input-field">
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div>
                <h3 class="text-lg font-display font-semibold text-white mb-4 border-b border-white/10 pb-2">Footer</h3>
                <div>
                    <label class="block text-slate-400 text-sm font-medium mb-2">Teks Footer</label>
                    <input type="text" name="footer_text" value="{{ $settings['footer_text'] ?? '' }}" class="input-field">
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="btn-primary">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                    <span>Simpan Pengaturan</span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
