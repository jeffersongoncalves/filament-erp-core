<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Designations;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Core\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Core\FilamentErpCorePlugin;
use JeffersonGoncalves\FilamentErp\Core\Resources\Designations\Pages\CreateDesignation;
use JeffersonGoncalves\FilamentErp\Core\Resources\Designations\Pages\EditDesignation;
use JeffersonGoncalves\FilamentErp\Core\Resources\Designations\Pages\ListDesignations;
use JeffersonGoncalves\FilamentErp\Core\Resources\Designations\Schemas\DesignationForm;
use JeffersonGoncalves\FilamentErp\Core\Resources\Designations\Tables\DesignationsTable;

class DesignationResource extends Resource
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::designation();
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
        return DesignationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DesignationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDesignations::route('/'),
            'create' => CreateDesignation::route('/create'),
            'edit' => EditDesignation::route('/{record}/edit'),
        ];
    }
}
