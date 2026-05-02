<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = PortfolioSetting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $path = $file->store('portfolio', 'public');
                PortfolioSetting::set($key, '/storage/' . $path, 'image');
            } else {
                PortfolioSetting::set($key, $value);
            }
        }

        // Handle file uploads separately
        $fileFields = ['avatar', 'cv_file', 'hero_image'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $path = $file->store('portfolio', 'public');
                PortfolioSetting::set($field, '/storage/' . $path, 'image');
            }
        }

        return back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}
