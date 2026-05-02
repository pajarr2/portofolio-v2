<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Experience;
use App\Models\PortfolioSetting;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\SocialLink;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects'   => Project::count(),
            'skills'     => Skill::count(),
            'services'   => Service::count(),
            'contacts'   => Contact::count(),
            'unread'     => Contact::unread()->count(),
            'experiences'=> Experience::count(),
        ];

        $recentContacts = Contact::latest()->take(5)->get();
        $featuredProjects = Project::featured()->active()->ordered()->take(4)->get();

        return view('admin.dashboard', compact('stats', 'recentContacts', 'featuredProjects'));
    }
}
