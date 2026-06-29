<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Brands;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Core\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Core\FilamentErpCorePlugin;
use JeffersonGoncalves\FilamentErp\Core\Resources\Brands\Pages\CreateBrand;
use JeffersonGoncalves\FilamentErp\Core\Resources\Brands\Pages\EditBrand;
use JeffersonGoncalves\FilamentErp\Core\Resources\Brands\Pages\ListBrands;
use JeffersonGoncalves\FilamentErp\Core\Resources\Brands\Schemas\BrandForm;
use JeffersonGoncalves\FilamentErp\Core\Resources\Brands\Tables\BrandsTable;

class BrandResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 7;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::brand();
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
        return BrandForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return BrandsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBrands::route('/'),
            'create' => CreateBrand::route('/create'),
            'edit' => EditBrand::route('/{record}/edit'),
        ];
    }
}
