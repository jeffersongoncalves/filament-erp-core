<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Uoms;

use Filament\Forms\Form;
use Filament\Resources\Resource;
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
    protected static ?string $navigationIcon = 'heroicon-o-scale';

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

    public static function form(Form $form): Form
    {
        return UomForm::configure($form);
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
