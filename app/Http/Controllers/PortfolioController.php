<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\PortfolioSetting;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $settings = PortfolioSetting::all()->pluck('value', 'key');
        $projects  = Project::active()->featured()->ordered()->take(6)->get();
        $skills    = Skill::active()->ordered()->get()->groupBy('category');
        $services  = Service::active()->ordered()->get();
        $experiences = Experience::active()->ordered()->take(4)->get();
        $educations  = Education::active()->ordered()->get();
        $socials   = SocialLink::active()->ordered()->get();

        return view('portfolio.index', compact(
            'settings', 'projects', 'skills', 'services', 'experiences', 'educations', 'socials'
        ));
    }

    public function projects()
    {
        $settings  = PortfolioSetting::all()->pluck('value', 'key');
        $projects  = Project::active()->ordered()->paginate(9);
        $socials   = SocialLink::active()->ordered()->get();
        return view('portfolio.projects', compact('settings', 'projects', 'socials'));
    }

    public function projectShow(string $slug)
    {
        $settings = PortfolioSetting::all()->pluck('value', 'key');
        $project  = Project::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $related  = Project::active()->where('id', '!=', $project->id)->ordered()->take(3)->get();
        $socials  = SocialLink::active()->ordered()->get();
        return view('portfolio.project-detail', compact('settings', 'project', 'related', 'socials'));
    }

    public function contact(Request $request)
    {
        $settings = PortfolioSetting::all()->pluck('value', 'key');
        $socials  = SocialLink::active()->ordered()->get();

        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'name'    => 'required|string|max:255',
                'email'   => 'required|email|max:255',
                'subject' => 'nullable|string|max:255',
                'message' => 'required|string|min:10',
            ]);

            Contact::create($validated);

            return back()->with('success', 'Pesan Anda berhasil dikirim! Saya akan segera menghubungi Anda.');
        }

        return view('portfolio.contact', compact('settings', 'socials'));
    }
}
