<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Experience;
use App\Models\PortfolioSetting;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\SocialLink;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(['email' => 'admin@portfolio.com'], [
            'name'     => 'Admin Portfolio',
            'email'    => 'admin@portfolio.com',
            'password' => Hash::make('password123'),
        ]);

        // // ── Portfolio Settings ─────────────────────────────────────────────────
        // $settings = [
        //     ['key' => 'name',           'value' => 'Rizky Pratama',       'group' => 'hero'],
        //     ['key' => 'tagline',        'value' => 'Full Stack Developer & UI/UX Designer', 'group' => 'hero'],
        //     ['key' => 'bio',            'value' => 'Saya adalah seorang Full Stack Developer dengan pengalaman 4+ tahun membangun aplikasi web yang estetis dan fungsional. Saya bersemangat menciptakan pengalaman digital yang luar biasa.', 'group' => 'hero'],
        //     ['key' => 'email',          'value' => 'rizky@example.com',    'group' => 'contact'],
        //     ['key' => 'phone',          'value' => '+62 812-3456-7890',    'group' => 'contact'],
        //     ['key' => 'location',       'value' => 'Jakarta, Indonesia',   'group' => 'contact'],
        //     ['key' => 'years_exp',      'value' => '4+',                   'group' => 'stats'],
        //     ['key' => 'projects_done',  'value' => '50+',                  'group' => 'stats'],
        //     ['key' => 'clients',        'value' => '20+',                  'group' => 'stats'],
        //     ['key' => 'open_to_work',   'value' => '1',                    'group' => 'general'],
        //     ['key' => 'hero_subtitle',  'value' => 'Membangun solusi digital yang elegan & berdampak', 'group' => 'hero'],
        //     ['key' => 'about_title',    'value' => 'Tentang Saya',         'group' => 'about'],
        //     ['key' => 'about_text',     'value' => 'Dengan latar belakang yang kuat di bidang Computer Science dan pengalaman bekerja dengan berbagai startup dan perusahaan Fortune 500, saya membawa pendekatan holistik dalam setiap proyek.', 'group' => 'about'],
        //     ['key' => 'cv_url',         'value' => '#',                    'group' => 'hero'],
        //     ['key' => 'footer_text',    'value' => 'Dibuat dengan ❤️ menggunakan Laravel & Tailwind CSS', 'group' => 'general'],
        // ];

        // foreach ($settings as $setting) {
        //     PortfolioSetting::set($setting['key'], $setting['value'], 'text', $setting['group']);
        // }

        // // ── Skills ─────────────────────────────────────────────────────────────
        // $skills = [
        //     ['name' => 'Laravel',     'level' => 95, 'category' => 'backend',  'color' => '#FF2D20', 'order' => 1],
        //     ['name' => 'PHP',         'level' => 90, 'category' => 'backend',  'color' => '#777BB4', 'order' => 2],
        //     ['name' => 'Node.js',     'level' => 80, 'category' => 'backend',  'color' => '#339933', 'order' => 3],
        //     ['name' => 'MySQL',       'level' => 85, 'category' => 'backend',  'color' => '#4479A1', 'order' => 4],
        //     ['name' => 'Vue.js',      'level' => 88, 'category' => 'frontend', 'color' => '#4FC08D', 'order' => 1],
        //     ['name' => 'React',       'level' => 82, 'category' => 'frontend', 'color' => '#61DAFB', 'order' => 2],
        //     ['name' => 'Tailwind CSS','level' => 95, 'category' => 'frontend', 'color' => '#06B6D4', 'order' => 3],
        //     ['name' => 'JavaScript',  'level' => 88, 'category' => 'frontend', 'color' => '#F7DF1E', 'order' => 4],
        //     ['name' => 'Docker',      'level' => 75, 'category' => 'tools',    'color' => '#2496ED', 'order' => 1],
        //     ['name' => 'Git',         'level' => 92, 'category' => 'tools',    'color' => '#F05032', 'order' => 2],
        //     ['name' => 'Figma',       'level' => 80, 'category' => 'design',   'color' => '#F24E1E', 'order' => 1],
        //     ['name' => 'AWS',         'level' => 70, 'category' => 'tools',    'color' => '#FF9900', 'order' => 3],
        // ];

        // foreach ($skills as $skill) {
        //     Skill::create($skill);
        // }

        // // ── Services ───────────────────────────────────────────────────────────
        // $services = [
        //     ['title' => 'Web Development',  'description' => 'Membangun aplikasi web full-stack yang scalable, cepat, dan aman menggunakan teknologi modern seperti Laravel, Vue.js, dan React.', 'icon' => 'code', 'color' => '#3B82F6', 'order' => 1],
        //     ['title' => 'UI/UX Design',     'description' => 'Merancang antarmuka yang intuitif dan estetis dengan fokus pada pengalaman pengguna yang menyenangkan menggunakan Figma.', 'icon' => 'palette', 'color' => '#8B5CF6', 'order' => 2],
        //     ['title' => 'API Development',  'description' => 'Membangun RESTful API dan GraphQL yang kuat, terdokumentasi, dan mudah diintegrasikan dengan berbagai platform.', 'icon' => 'server', 'color' => '#10B981', 'order' => 3],
        //     ['title' => 'Konsultasi IT',    'description' => 'Memberikan saran teknis strategis untuk membantu bisnis Anda bertumbuh dengan solusi teknologi yang tepat sasaran.', 'icon' => 'lightbulb', 'color' => '#F59E0B', 'order' => 4],
        // ];

        // foreach ($services as $service) {
        //     Service::create($service);
        // }

        // // ── Experiences ────────────────────────────────────────────────────────
        // Experience::create([
        //     'company'          => 'Gojek Indonesia',
        //     'position'         => 'Senior Full Stack Developer',
        //     'location'         => 'Jakarta, Indonesia',
        //     'description'      => 'Memimpin tim pengembangan untuk fitur-fitur core platform dengan jutaan pengguna aktif.',
        //     'responsibilities' => ['Memimpin tim 5 developer', 'Merancang arsitektur microservices', 'Meningkatkan performa API hingga 40%', 'Code review dan mentoring junior developer'],
        //     'start_date'       => '2022-03-01',
        //     'is_current'       => true,
        //     'order'            => 1,
        // ]);

        // Experience::create([
        //     'company'          => 'Tokopedia',
        //     'position'         => 'Full Stack Developer',
        //     'location'         => 'Jakarta, Indonesia',
        //     'description'      => 'Mengembangkan fitur e-commerce untuk platform terbesar di Indonesia.',
        //     'responsibilities' => ['Membangun fitur payment gateway', 'Optimasi query database', 'Integrasi third-party API', 'Menulis unit dan integration tests'],
        //     'start_date'       => '2020-06-01',
        //     'end_date'         => '2022-02-28',
        //     'is_current'       => false,
        //     'order'            => 2,
        // ]);

        // Experience::create([
        //     'company'          => 'Startup Lokal XYZ',
        //     'position'         => 'Junior Backend Developer',
        //     'location'         => 'Bandung, Indonesia',
        //     'description'      => 'Memulai karier sebagai backend developer di startup fintech lokal.',
        //     'responsibilities' => ['Membangun REST API dengan Laravel', 'Mengelola database MySQL', 'Deployment di VPS'],
        //     'start_date'       => '2019-01-01',
        //     'end_date'         => '2020-05-31',
        //     'is_current'       => false,
        //     'order'            => 3,
        // ]);

        // // ── Educations ─────────────────────────────────────────────────────────
        // Education::create([
        //     'institution'    => 'Institut Teknologi Bandung',
        //     'degree'         => 'Sarjana (S1)',
        //     'field_of_study' => 'Teknik Informatika',
        //     'location'       => 'Bandung, Indonesia',
        //     'description'    => 'Lulus dengan predikat Cumlaude. Fokus riset pada Machine Learning dan Web Security.',
        //     'start_date'     => '2015-08-01',
        //     'end_date'       => '2019-07-31',
        //     'order'          => 1,
        // ]);

        // // ── Social Links ───────────────────────────────────────────────────────
        $socials = [
            ['platform' => 'GitHub',    'url' => 'https://github.com/pajarr2', 'icon' => 'github',   'order' => 1],
            ['platform' => 'LinkedIn',  'url' => 'https://www.linkedin.com/in/pajar-09a1a023b/','icon' => 'linkedin', 'order' => 2],
            // ['platform' => 'Twitter',   'url' => 'https://twitter.com', 'icon' => 'twitter',  'order' => 3],
            ['platform' => 'Instagram', 'url' => 'https://www.instagram.com/pajarrm._/','icon' => 'instagram','order' => 4],
        ];

        foreach ($socials as $social) {
            SocialLink::updateOrCreate(
                [
                    'platform' => $social['platform'],
                ],
                $social
            );
        }

        // // ── Projects ───────────────────────────────────────────────────────────
        // $projects = [
        //     [
        //         'title'        => 'E-Commerce Platform',
        //         'slug'         => 'e-commerce-platform',
        //         'description'  => 'Platform e-commerce full-featured dengan payment gateway, manajemen inventori, dan dashboard analytics real-time.',
        //         'long_description' => 'Platform e-commerce yang dibangun dari awal dengan Laravel 11 dan Vue.js 3. Fitur lengkap meliputi manajemen produk, keranjang belanja, multiple payment gateway (Midtrans, Xendit), sistem notifikasi, dashboard analytics dengan chart real-time, dan PWA support.',
        //         'technologies' => ['Laravel', 'Vue.js', 'Tailwind CSS', 'MySQL', 'Redis', 'Docker'],
        //         'category'     => 'web',
        //         'featured'     => true,
        //         'order'        => 1,
        //     ],
        //     [
        //         'title'        => 'Project Management SaaS',
        //         'slug'         => 'project-management-saas',
        //         'description'  => 'Aplikasi manajemen proyek berbasis SaaS dengan fitur Kanban board, time tracking, dan kolaborasi tim real-time.',
        //         'long_description' => 'SaaS application untuk manajemen proyek tim dengan fitur Kanban board drag-and-drop, time tracking, milestone tracking, file sharing, dan chat real-time menggunakan WebSocket.',
        //         'technologies' => ['Laravel', 'React', 'Tailwind CSS', 'PostgreSQL', 'WebSocket', 'AWS'],
        //         'category'     => 'web',
        //         'featured'     => true,
        //         'order'        => 2,
        //     ],
        //     [
        //         'title'        => 'Mobile Banking App',
        //         'slug'         => 'mobile-banking-app',
        //         'description'  => 'Aplikasi mobile banking dengan fitur transfer, pembayaran tagihan, dan investasi reksa dana.',
        //         'long_description' => 'Backend API untuk aplikasi mobile banking yang digunakan oleh 50,000+ pengguna aktif. Dibangun dengan fokus keamanan tinggi, encryption end-to-end, dan compliance peraturan OJK.',
        //         'technologies' => ['Laravel', 'REST API', 'MySQL', 'Redis', 'Docker', 'Kubernetes'],
        //         'category'     => 'api',
        //         'featured'     => true,
        //         'order'        => 3,
        //     ],
        //     [
        //         'title'        => 'HR Management System',
        //         'slug'         => 'hr-management-system',
        //         'description'  => 'Sistem manajemen SDM lengkap dengan payroll, absensi, rekrutmen, dan performance review.',
        //         'long_description' => 'Sistem HR komprehensif yang mengelola seluruh siklus karyawan dari rekrutmen hingga offboarding. Fitur otomasi payroll, integrasi fingerprint device, dan laporan HR yang detail.',
        //         'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Tailwind CSS', 'Chart.js'],
        //         'category'     => 'web',
        //         'featured'     => false,
        //         'order'        => 4,
        //     ],
        //     [
        //         'title'        => 'Real Estate Platform',
        //         'slug'         => 'real-estate-platform',
        //         'description'  => 'Platform properti dengan pencarian berbasis peta, virtual tour 360°, dan sistem KPR online.',
        //         'long_description' => 'Platform properti modern dengan fitur pencarian canggih, filter multi-kriteria, tampilan peta interaktif (Mapbox), virtual tour 360° menggunakan Three.js, dan kalkulator KPR terintegrasi.',
        //         'technologies' => ['Laravel', 'Vue.js', 'Mapbox', 'Three.js', 'MySQL', 'Algolia'],
        //         'category'     => 'web',
        //         'featured'     => false,
        //         'order'        => 5,
        //     ],
        //     [
        //         'title'        => 'Food Delivery API',
        //         'slug'         => 'food-delivery-api',
        //         'description'  => 'RESTful API untuk aplikasi food delivery dengan tracking order real-time dan integrasi driver.',
        //         'long_description' => 'Backend API lengkap untuk platform food delivery dengan fitur real-time order tracking menggunakan WebSocket, algoritma penugasan driver otomatis, integrasi payment multiple gateway, dan sistem rating & review.',
        //         'technologies' => ['Laravel', 'REST API', 'WebSocket', 'Redis', 'MySQL', 'Firebase'],
        //         'category'     => 'api',
        //         'featured'     => false,
        //         'order'        => 6,
        //     ],
        // ];

        // foreach ($projects as $project) {
        //     Project::create($project);
        // }
    }
}
