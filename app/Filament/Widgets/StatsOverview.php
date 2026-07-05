<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\ExperienceEntry;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Visit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Projects', Project::count())
                ->description('Live on the portfolio')
                ->icon('heroicon-o-rectangle-stack')
                ->color('primary'),

            Stat::make('Experience entries', ExperienceEntry::count())
                ->icon('heroicon-o-briefcase')
                ->color('gray'),

            Stat::make('Skills', Skill::count())
                ->icon('heroicon-o-sparkles')
                ->color('gray'),

            Stat::make('Unread messages', ContactMessage::whereNull('read_at')->count())
                ->icon('heroicon-o-envelope')
                ->color('danger'),

            Stat::make('Visits today', Visit::whereDate('created_at', today())->count())
                ->icon('heroicon-o-eye')
                ->color('success'),
        ];
    }
}
