<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::ordered()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'long_description' => 'nullable|string',
            'demo_url'         => 'nullable|url',
            'github_url'       => 'nullable|url',
            'category'         => 'required|string',
            'technologies'     => 'nullable|string',
            'featured'         => 'boolean',
            'is_active'        => 'boolean',
            'order'            => 'integer',
            'thumbnail'        => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['featured']  = $request->boolean('featured');
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->filled('technologies')) {
            $validated['technologies'] = array_map('trim', explode(',', $request->technologies));
        }

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('projects', 'public');
            $validated['thumbnail'] = '/storage/' . $path;
        }

        Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil ditambahkan!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'long_description' => 'nullable|string',
            'demo_url'         => 'nullable|url',
            'github_url'       => 'nullable|url',
            'category'         => 'required|string',
            'technologies'     => 'nullable|string',
            'featured'         => 'boolean',
            'is_active'        => 'boolean',
            'order'            => 'integer',
            'thumbnail'        => 'nullable|image|max:2048',
        ]);

        $validated['slug']      = Str::slug($validated['title']);
        $validated['featured']  = $request->boolean('featured');
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->filled('technologies')) {
            $validated['technologies'] = array_map('trim', explode(',', $request->technologies));
        }

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('projects', 'public');
            $validated['thumbnail'] = '/storage/' . $path;
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return back()->with('success', 'Project berhasil dihapus!');
    }
}
