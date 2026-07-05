<?php

namespace App\Filament\Resources\ExperienceEntryResource\Pages;

use App\Filament\Resources\ExperienceEntryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExperienceEntry extends EditRecord
{
    protected static string $resource = ExperienceEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
