<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Uoms;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Core\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Core\FilamentErpCorePlugin;
use JeffersonGoncalves\FilamentErp\Core\Resources\Uoms\Pages\CreateUom;
use JeffersonGoncalves\FilamentErp\Core\Resources\Uoms\Pages\EditUom;
use JeffersonGoncalves\FilamentErp\Core\Resources\Uoms\Pages\ListUoms;
use JeffersonGoncalves\FilamentErp\Core\Resources\Uoms\Schemas\UomForm;
use JeffersonGoncalves\FilamentErp\Core\Resources\Uoms\Tables\UomsTable;

class UomResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedScale;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::uom();
    }

    public static function getModelLabel(): string
    {
        return 'Unit of Measure';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Units of Measure';
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
        return UomForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UomsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUoms::route('/'),
            'create' => CreateUom::route('/create'),
            'edit' => EditUom::route('/{record}/edit'),
        ];
    }
}
