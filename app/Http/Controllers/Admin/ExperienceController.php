<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::ordered()->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company'          => 'required|string|max:255',
            'position'         => 'required|string|max:255',
            'location'         => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'start_date'       => 'required|date',
            'end_date'         => 'nullable|date',
            'is_current'       => 'boolean',
            'is_active'        => 'boolean',
            'order'            => 'integer',
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        $validated['is_active']  = $request->boolean('is_active', true);

        if ($request->filled('responsibilities')) {
            $validated['responsibilities'] = array_filter(array_map('trim', explode("\n", $request->responsibilities)));
        }

        Experience::create($validated);
        return back()->with('success', 'Pengalaman berhasil ditambahkan!');
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'company'          => 'required|string|max:255',
            'position'         => 'required|string|max:255',
            'location'         => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'responsibilities' => 'nullable|string',
            'start_date'       => 'required|date',
            'end_date'         => 'nullable|date',
            'is_current'       => 'boolean',
            'is_active'        => 'boolean',
            'order'            => 'integer',
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        $validated['is_active']  = $request->boolean('is_active', true);

        if ($request->filled('responsibilities')) {
            $validated['responsibilities'] = array_filter(array_map('trim', explode("\n", $request->responsibilities)));
        }

        $experience->update($validated);
        return back()->with('success', 'Pengalaman berhasil diperbarui!');
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return back()->with('success', 'Pengalaman berhasil dihapus!');
    }
}
