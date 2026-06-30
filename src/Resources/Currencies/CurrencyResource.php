<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Currencies;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Core\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Core\FilamentErpCorePlugin;
use JeffersonGoncalves\FilamentErp\Core\Resources\Currencies\Pages\CreateCurrency;
use JeffersonGoncalves\FilamentErp\Core\Resources\Currencies\Pages\EditCurrency;
use JeffersonGoncalves\FilamentErp\Core\Resources\Currencies\Pages\ListCurrencies;
use JeffersonGoncalves\FilamentErp\Core\Resources\Currencies\Schemas\CurrencyForm;
use JeffersonGoncalves\FilamentErp\Core\Resources\Currencies\Tables\CurrenciesTable;

class CurrencyResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::currency();
    }

    public static function getNavigationGroup(): ?string
    {
        try {
            return FilamentErpCorePlugin::get()->getNavigationGroup();
        } catch (\Throwable) {
            return config('filament-erp-core.navigation_group', 'ERP — Core');
        }
    }

    public static function form(Schema $schema): Schema
    {
        return CurrencyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CurrenciesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCurrencies::route('/'),
            'create' => CreateCurrency::route('/create'),
            'edit' => EditCurrency::route('/{record}/edit'),
        ];
    }
}
