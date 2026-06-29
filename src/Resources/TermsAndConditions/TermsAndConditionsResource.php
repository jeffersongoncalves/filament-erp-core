<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\TermsAndConditions;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Core\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Core\FilamentErpCorePlugin;
use JeffersonGoncalves\FilamentErp\Core\Resources\TermsAndConditions\Pages\CreateTermsAndConditions;
use JeffersonGoncalves\FilamentErp\Core\Resources\TermsAndConditions\Pages\EditTermsAndConditions;
use JeffersonGoncalves\FilamentErp\Core\Resources\TermsAndConditions\Pages\ListTermsAndConditions;
use JeffersonGoncalves\FilamentErp\Core\Resources\TermsAndConditions\Schemas\TermsAndConditionsForm;
use JeffersonGoncalves\FilamentErp\Core\Resources\TermsAndConditions\Tables\TermsAndConditionsTable;

class TermsAndConditionsResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 8;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::termsAndConditions();
    }

    public static function getModelLabel(): string
    {
        return 'Terms and Conditions';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Terms and Conditions';
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
        return TermsAndConditionsForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return TermsAndConditionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTermsAndConditions::route('/'),
            'create' => CreateTermsAndConditions::route('/create'),
            'edit' => EditTermsAndConditions::route('/{record}/edit'),
        ];
    }
}
