<?php

namespace App\Filament\Resources\PricingLeadResource\Pages;

use App\Filament\Resources\PricingLeadResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPricingLead extends ViewRecord
{
    protected static string $resource = PricingLeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
