<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\TermsAndConditions\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use JeffersonGoncalves\FilamentErp\Core\Resources\TermsAndConditions\TermsAndConditionsResource;

class EditTermsAndConditions extends EditRecord
{
    protected static string $resource = TermsAndConditionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
