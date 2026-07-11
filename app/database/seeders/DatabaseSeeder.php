<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use App\Models\ExperienceEntry;
use App\Models\Feedback;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'ronnielegaspi98@gmail.com'],
            [
                'name' => 'Ronnie Legaspi',
                'password' => bcrypt('PortfolioAdmin!2026'),
            ]
        );

        Profile::updateOrCreate(['id' => 1], [
            'name' => 'Ronnie H. Legaspi',
            'hero_heading' => 'Building reliable web and software applications with Laravel, React.js, PHP, and MySQL.',
            'hero_subheading' => "I'm Ronnie Legaspi, a BSIT graduate from the University of Eastern Pangasinan, eager to grow a career in IT and software development — turning ideas into working software, one commit at a time.",
            'about_paragraph_1' => 'I build web and software applications using Laravel, React.js, PHP, MySQL, JavaScript, C#, and Unity. Proficient in database management, technical support, and Microsoft Office applications.',
            'about_paragraph_2' => "During my internship at AeonSprint Solutions Inc., I contributed to full-stack development, API integration, database management, and system maintenance on real production systems — and I'm eager to begin a professional career in IT, software development, web development, or administrative support, while continuously learning and contributing to organizational goals.",
            'email' => 'ronnielegaspi98@gmail.com',
            'phone' => '+639930954435',
            'location' => 'Villegas, Pozorrubio, Pangasinan',
            'website_url' => 'https://ronnie-legaspi.vercel.app',
            'stats_months_internship' => 5,
            'stats_technologies' => 8,
            'stats_percent_learning' => 100,
        ]);

        if (Project::count() === 0) {
            Project::insert([
                [
                    'title' => "The Tales of Carlos Bulosan: A Hero's Journey",
                    'subtitle' => '3D Game-Based Learning Platform',
                    'description' => 'Developed a Unity-based educational game using C#, MySQL and Laravel/Vue.js integration, focused on interactive learning and backend functionality, while promoting Filipino culture through an engaging and gamified experience.',
                    'tags' => json_encode(['Unity', 'C#', 'Laravel', 'MySQL']),
                    'image_url' => 'https://picsum.photos/seed/bulosan/800/500',
                    'repo_url' => null,
                    'demo_url' => null,
                    'rating' => 4.8,
                    'featured' => true,
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'JobDocs Roadmap',
                    'subtitle' => 'Web-Based Formal Guide for Common Employment Documents',
                    'description' => 'Built a web-based Job Documents Roadmap using React.js to guide confused fresh graduates in understanding and completing job requirements, providing structured information such as procedures, locations, and estimated costs.',
                    'tags' => json_encode(['React.js', 'JavaScript']),
                    'image_url' => 'https://picsum.photos/seed/jobdocs/800/500',
                    'repo_url' => null,
                    'demo_url' => null,
                    'rating' => 4.5,
                    'featured' => true,
                    'sort_order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'BadgerMint',
                    'subtitle' => 'Mini Application Integration',
                    'description' => 'Participated in frontend development and mini application integration, contributing to a fun and engaging experience within the main system during my internship at AeonSprint Solutions Inc.',
                    'tags' => json_encode(['Laravel', 'React.js']),
                    'image_url' => 'https://picsum.photos/seed/badgermint/800/500',
                    'repo_url' => null,
                    'demo_url' => null,
                    'rating' => 4.2,
                    'featured' => false,
                    'sort_order' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        if (ExperienceEntry::count() === 0) {
            ExperienceEntry::insert([
                [
                    'type' => 'work',
                    'title' => 'Full Stack Developer (Intern)',
                    'organization' => 'AeonSprint Solutions Inc.',
                    'period_label' => '02/2026 – 06/2026',
                    'bullets' => json_encode([
                        'Assisted in the development of web applications using Laravel and Vue.js/React.js, contributing to both frontend and backend development. Participated in API integration, database management, debugging, and system maintenance to support application functionality and performance.',
                        'Contributed to the development of an NFC-based attendance application using Laravel and React.js, with involvement in frontend and backend development, service integration, and database management.',
                        'Worked on web development, system optimization, database architecture, and UI/UX improvements.',
                        'Participated in the development of mini applications integrated into the main system (BadgerMint), contributing to feature implementation, testing, and system enhancement.',
                        'Co-hosted a webinar on "Bridging AI, Startups, and Secure Governance," facilitating discussions on emerging technologies, innovation, and cybersecurity best practices.',
                    ]),
                    'description' => null,
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type' => 'education',
                    'title' => 'Bachelor of Science in Information Technology',
                    'organization' => 'University of Eastern Pangasinan (UEP)',
                    'period_label' => '2022 – 2026',
                    'bullets' => null,
                    'description' => 'Capstone Leadership and Lead Programmer.',
                    'sort_order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'type' => 'note',
                    'title' => 'Core strengths',
                    'organization' => null,
                    'period_label' => null,
                    'bullets' => null,
                    'description' => 'Full-stack web development, database management, technical support, and Microsoft Office applications — with a continuous drive to learn and contribute to organizational goals.',
                    'sort_order' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        if (Skill::count() === 0) {
            $groups = [
                'Web & Software Development' => ['Laravel (PHP)', 'React.js', 'Vue.js', 'JavaScript', 'TypeScript', 'HTML', 'CSS', 'Microsoft Office Suite'],
                'Database & System Management' => ['MySQL', 'Database Management', 'System Deployment', 'Basic Server Setup'],
                'Administrative & Office Skills' => ['Data Entry', 'Documentation', 'Report Preparation', 'Technical Support'],
                'IT & Technical Support' => ['Hardware/Software Troubleshooting', 'Basic Networking', 'System Maintenance', 'User Support'],
                'Additional Skills' => ['Unity', 'C#', 'Git', 'GitHub', 'Collaborative Teamwork'],
            ];

            $groupOrder = 0;
            foreach ($groups as $groupName => $skills) {
                $groupOrder++;
                foreach ($skills as $i => $skillName) {
                    Skill::create([
                        'group_name' => $groupName,
                        'name' => $skillName,
                        'sort_order' => $groupOrder * 100 + $i,
                    ]);
                }
            }
        }

        if (ContactMessage::count() === 0) {
            ContactMessage::create([
                'name' => 'Sample Visitor',
                'email' => 'visitor@example.com',
                'message' => "Hi Ronnie, I saw your portfolio and I'd love to talk about a potential opportunity!",
            ]);
        }

        if (Feedback::count() === 0) {
            Feedback::create([
                'name' => 'Sample Visitor',
                'email' => null,
                'rating' => 5,
                'message' => 'Really clean layout and the project write-ups are clear. Nice work!',
                'page' => '/',
            ]);
        }

        if (Post::count() === 0) {
            Post::insert([
                [
                    'title' => 'Building an NFC Attendance System with Laravel and React',
                    'slug' => 'nfc-attendance-system-laravel-react',
                    'excerpt' => 'Notes from my internship on wiring NFC hardware events into a Laravel API and a React front end for real-time attendance tracking.',
                    'body' => "During my internship at AeonSprint Solutions Inc., one of the projects I worked on was an NFC-based attendance application. The backend was built with Laravel, exposing a small set of REST endpoints that accepted tap events from the NFC reader and matched them against employee records in MySQL. The front end used React to show a live attendance feed as taps came in.\n\nA few things I learned along the way: keeping the API contract between the reader service and Laravel dead simple made debugging hardware issues much easier, and using database transactions around each check-in/check-out pair avoided duplicate or inconsistent records when the reader occasionally double-fired. I also spent time on UI/UX polish so the live feed felt instant rather than laggy, which mattered a lot for a tool people would be looking at daily.\n\nIt was a great introduction to working across hardware, backend, and frontend in a single feature, and it's shaped how I think about designing APIs that need to stay reliable under real-world, imperfect input.",
                    'cover_image_url' => 'https://picsum.photos/seed/nfc-attendance/900/500',
                    'tags' => json_encode(['Laravel', 'React.js', 'MySQL']),
                    'reading_minutes' => 4,
                    'published_at' => now()->subDays(18),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Lessons from Building a Unity Game with a Laravel Backend',
                    'slug' => 'unity-game-laravel-backend-lessons',
                    'excerpt' => "What I learned leading my capstone project — a 3D game-based learning platform built in Unity with C# and a Laravel/MySQL backend.",
                    'body' => "My capstone project, \"The Tales of Carlos Bulosan: A Hero's Journey,\" was a 3D game-based learning platform built in Unity with C#, integrated with a Laravel and MySQL backend. As Capstone Leadership and Lead Programmer, I was responsible for both the gameplay systems and the server-side pieces that stored player progress and learning content.\n\nThe biggest challenge was designing a clean boundary between the game client and the backend — Unity's WWWForm/UnityWebRequest calls needed to talk to Laravel API routes without assuming anything about frame timing or scene state. I ended up treating the backend purely as a stateless progress/content API and kept all game logic on the Unity side, which made both halves much easier to test independently.\n\nThe project also reinforced how much good API design work carries over between very different front ends — the same instincts I use building React or Vue interfaces against Laravel applied directly to wiring up a Unity client.",
                    'cover_image_url' => 'https://picsum.photos/seed/unity-capstone/900/500',
                    'tags' => json_encode(['Unity', 'C#', 'Laravel']),
                    'reading_minutes' => 5,
                    'published_at' => now()->subDays(9),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Why Laravel Is My Go-To Backend Framework',
                    'slug' => 'why-laravel-is-my-go-to-backend-framework',
                    'excerpt' => "A few reasons Laravel has become the framework I reach for first, from expressive Eloquent models to how fast Livewire lets me ship interactive UI.",
                    'body' => "Across my internship and personal projects, Laravel has consistently been the framework I reach for first. A few reasons why:\n\nEloquent makes working with MySQL feel natural — relationships, casts, and scopes let me express business logic close to the data instead of scattering raw queries everywhere. Livewire (which powers the interactive parts of this very site) lets me build reactive UI without maintaining a separate JavaScript API layer for every small feature, which is a huge speed boost for a small team or solo developer. And the ecosystem — Filament for admin panels, Laravel's built-in validation and queueing, artisan for scaffolding — means I spend more time on the actual problem and less on plumbing.\n\nI still reach for React or Vue when a project needs a heavier client-side experience, but for most full-stack web apps, Laravel plus Livewire gets me from idea to working software faster than anything else I've used.",
                    'cover_image_url' => 'https://picsum.photos/seed/laravel-love/900/500',
                    'tags' => json_encode(['Laravel', 'Livewire', 'PHP']),
                    'reading_minutes' => 3,
                    'published_at' => now()->subDays(2),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
