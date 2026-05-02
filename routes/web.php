<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

// ── Frontend Portfolio Routes ────────────────────────────────────────────────
Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/projects', [PortfolioController::class, 'projects'])->name('portfolio.projects');
Route::get('/projects/{slug}', [PortfolioController::class, 'projectShow'])->name('portfolio.project.show');
Route::match(['get', 'post'], '/contact', [PortfolioController::class, 'contact'])->name('portfolio.contact');

// ── Admin Routes ─────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

    // Projects
    Route::resource('projects', ProjectController::class);

    // Skills
    Route::get('skills', [SkillController::class, 'index'])->name('skills.index');
    Route::post('skills', [SkillController::class, 'store'])->name('skills.store');
    Route::put('skills/{skill}', [SkillController::class, 'update'])->name('skills.update');
    Route::delete('skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');

    // Experiences
    Route::get('experiences', [ExperienceController::class, 'index'])->name('experiences.index');
    Route::post('experiences', [ExperienceController::class, 'store'])->name('experiences.store');
    Route::put('experiences/{experience}', [ExperienceController::class, 'update'])->name('experiences.update');
    Route::delete('experiences/{experience}', [ExperienceController::class, 'destroy'])->name('experiences.destroy');

    // Contacts
    Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
});

// ── Auth Routes ──────────────────────────────────────────────────────────────
Route::get('admin/login', function () {
    return view('admin.auth.login');
})->name('login');

Route::post('admin/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (\Illuminate\Support\Facades\Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'));
    }

    return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
})->name('login.post');

Route::post('admin/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('portfolio.index');
})->name('logout');
