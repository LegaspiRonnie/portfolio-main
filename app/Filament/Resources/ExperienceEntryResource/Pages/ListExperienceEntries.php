<?php

namespace App\Filament\Resources\ExperienceEntryResource\Pages;

use App\Filament\Resources\ExperienceEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExperienceEntries extends ListRecords
{
    protected static string $resource = ExperienceEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
