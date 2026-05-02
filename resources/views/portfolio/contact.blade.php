@extends('layouts.portfolio')
@section('title', 'Kontak')

@section('content')
<section class="pt-32 pb-24">
    <div class="max-w-5xl mx-auto px-6">
        <!-- Header -->
        <div class="text-center mb-16 fade-in">
            <div class="section-label justify-center">Get in Touch</div>
            <h1 class="font-display font-extrabold text-4xl md:text-5xl text-white mt-3">Hubungi Saya</h1>
            <p class="text-slate-500 mt-4 max-w-xl mx-auto text-lg">Punya pertanyaan atau ingin berkolaborasi? Saya siap mendengar!</p>
        </div>

        @if(session('success'))
        <div class="mb-8 p-4 rounded-xl flex items-center gap-3 text-emerald-400 fade-in"
             style="background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.3);">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        <div class="grid lg:grid-cols-5 gap-10">
            <!-- Contact info -->
            <div class="lg:col-span-2 space-y-5 fade-in">
                @if($settings['email'] ?? false)
                <div class="glass-card p-5 flex items-center gap-4 hover:scale-105 transition-transform">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                         style="background: rgba(12,144,233,0.1); border: 1px solid rgba(12,144,233,0.2);">
                        <svg class="w-5 h-5 text-[#36aaf8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-slate-500 text-xs uppercase tracking-wide">Email</p>
                        <a href="mailto:{{ $settings['email'] }}" class="text-white font-medium hover:text-[#36aaf8] transition-colors text-sm">{{ $settings['email'] }}</a>
                    </div>
                </div>
                @endif

                @if($settings['phone'] ?? false)
                <div class="glass-card p-5 flex items-center gap-4 hover:scale-105 transition-transform">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                         style="background: rgba(12,144,233,0.1); border: 1px solid rgba(12,144,233,0.2);">
                        <svg class="w-5 h-5 text-[#36aaf8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-slate-500 text-xs uppercase tracking-wide">Telepon</p>
                        <p class="text-white font-medium text-sm">{{ $settings['phone'] }}</p>
                    </div>
                </div>
                @endif

                @if($settings['location'] ?? false)
                <div class="glass-card p-5 flex items-center gap-4 hover:scale-105 transition-transform">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                         style="background: rgba(12,144,233,0.1); border: 1px solid rgba(12,144,233,0.2);">
                        <svg class="w-5 h-5 text-[#36aaf8]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-slate-500 text-xs uppercase tracking-wide">Lokasi</p>
                        <p class="text-white font-medium text-sm">{{ $settings['location'] }}</p>
                    </div>
                </div>
                @endif

                <!-- Socials -->
                <div class="glass-card p-5">
                    <p class="text-slate-500 text-xs uppercase tracking-wide mb-4">Temukan Saya</p>
                    <div class="flex flex-wrap gap-3">
                        @foreach($socials as $social)
                        <a href="{{ $social->url }}" target="_blank"
                           class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium text-slate-400 hover:text-[#36aaf8] transition-all hover:-translate-y-0.5"
                           style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.06);">
                            @include('partials.social-icon', ['platform' => $social->icon])
                            {{ $social->platform }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-3 fade-in">
                <div class="glass-card p-8">
                    <h2 class="font-display font-bold text-xl text-white mb-6">Kirim Pesan</h2>
                    <form action="{{ route('portfolio.contact') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-slate-400 text-sm font-medium mb-2">Nama *</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                       class="input-field @error('name') border-red-500/50 @enderror"
                                       placeholder="John Doe">
                                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-slate-400 text-sm font-medium mb-2">Email *</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                       class="input-field @error('email') border-red-500/50 @enderror"
                                       placeholder="john@example.com">
                                @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-slate-400 text-sm font-medium mb-2">Subject</label>
                            <input type="text" name="subject" value="{{ old('subject') }}"
                                   class="input-field" placeholder="Tentang project saya...">
                        </div>
                        <div>
                            <label class="block text-slate-400 text-sm font-medium mb-2">Pesan *</label>
                            <textarea name="message" rows="5" required
                                      class="input-field resize-none @error('message') border-red-500/50 @enderror"
                                      placeholder="Ceritakan tentang project atau pertanyaan Anda...">{{ old('message') }}</textarea>
                            @error('message')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <button type="submit" class="btn-primary w-full justify-center py-3">
                            <svg class="w-4 h-4 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            <span>Kirim Pesan</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
