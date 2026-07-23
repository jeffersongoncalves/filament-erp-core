<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Companies;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Core\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Core\FilamentErpCorePlugin;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\Pages\CreateCompany;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\Pages\EditCompany;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\Pages\ListCompanies;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\RelationManagers\AddressRelationManager;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\RelationManagers\ContactRelationManager;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\Schemas\CompanyForm;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\Tables\CompaniesTable;

class CompanyResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::company();
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
        return CompanyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompaniesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            AddressRelationManager::class,
            ContactRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCompanies::route('/'),
            'create' => CreateCompany::route('/create'),
            'edit' => EditCompany::route('/{record}/edit'),
        ];
    }
}
