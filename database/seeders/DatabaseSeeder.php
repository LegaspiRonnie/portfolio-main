<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use App\Models\ExperienceEntry;
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
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'JobDocs Roadmap',
                    'subtitle' => 'Web-Based Formal Guide for Common Employment Documents',
                    'description' => 'Built a web-based Job Documents Roadmap using React.js to guide confused fresh graduates in understanding and completing job requirements, providing structured information such as procedures, locations, and estimated costs.',
                    'tags' => json_encode(['React.js', 'JavaScript']),
                    'sort_order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'BadgerMint',
                    'subtitle' => 'Mini Application Integration',
                    'description' => 'Participated in frontend development and mini application integration, contributing to a fun and engaging experience within the main system during my internship at AeonSprint Solutions Inc.',
                    'tags' => json_encode(['Laravel', 'React.js']),
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
    }
}
