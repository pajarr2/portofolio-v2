<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::ordered()->get()->groupBy('category');
        return view('admin.skills.index', compact('skills'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'level'     => 'required|integer|min:0|max:100',
            'category'  => 'required|string',
            'color'     => 'nullable|string',
            'is_active' => 'boolean',
            'order'     => 'integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active', true);
        Skill::create($validated);
        return back()->with('success', 'Skill berhasil ditambahkan!');
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'level'     => 'required|integer|min:0|max:100',
            'category'  => 'required|string',
            'color'     => 'nullable|string',
            'is_active' => 'boolean',
            'order'     => 'integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active', true);
        $skill->update($validated);
        return back()->with('success', 'Skill berhasil diperbarui!');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return back()->with('success', 'Skill berhasil dihapus!');
    }
}
