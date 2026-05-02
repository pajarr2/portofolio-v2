<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Admin Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#08101e] text-slate-200 antialiased min-h-screen flex items-center justify-center p-6 relative">
    <div class="absolute inset-0 dot-grid opacity-30"></div>

    <div class="glass-card w-full max-w-md p-8 relative z-10" style="border-color: rgba(12,144,233,0.3);">
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-4 pulse-glow"
                 style="background: linear-gradient(135deg, #0c90e9, #0159a1);">
                <span class="text-white font-bold text-xl">A</span>
            </div>
            <h1 class="text-2xl font-display font-bold text-white mb-2">Admin Panel</h1>
            <p class="text-slate-500 text-sm">Silakan login untuk mengelola portfolio Anda</p>
        </div>

        @if($errors->any())
        <div class="mb-6 p-3 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 text-sm text-center">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-slate-400 text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="input-field" placeholder="admin@example.com">
            </div>
            <div>
                <label class="block text-slate-400 text-sm font-medium mb-2">Password</label>
                <input type="password" name="password" required
                       class="input-field" placeholder="••••••••">
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="rounded border-slate-700 bg-slate-800 text-[#0c90e9] focus:ring-[#0c90e9] focus:ring-offset-slate-900">
                <label for="remember" class="ml-2 text-sm text-slate-400">Ingat Saya</label>
            </div>
            <button type="submit" class="btn-primary w-full justify-center">
                <span>Login ke Dashboard</span>
            </button>
        </form>
    </div>
</body>
</html>
