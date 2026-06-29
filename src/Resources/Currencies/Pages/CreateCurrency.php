<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Currencies\Pages;

use Filament\Resources\Pages\CreateRecord;
use JeffersonGoncalves\FilamentErp\Core\Resources\Currencies\CurrencyResource;

class CreateCurrency extends CreateRecord
{
    protected static string $resource = CurrencyResource::class;
}
