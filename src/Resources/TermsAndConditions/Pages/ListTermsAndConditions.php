<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\TermsAndConditions\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use JeffersonGoncalves\FilamentErp\Core\Resources\TermsAndConditions\TermsAndConditionsResource;

class ListTermsAndConditions extends ListRecords
{
    protected static string $resource = TermsAndConditionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
