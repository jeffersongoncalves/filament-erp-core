<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\FiscalYears;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Core\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Core\FilamentErpCorePlugin;
use JeffersonGoncalves\FilamentErp\Core\Resources\FiscalYears\Pages\CreateFiscalYear;
use JeffersonGoncalves\FilamentErp\Core\Resources\FiscalYears\Pages\EditFiscalYear;
use JeffersonGoncalves\FilamentErp\Core\Resources\FiscalYears\Pages\ListFiscalYears;
use JeffersonGoncalves\FilamentErp\Core\Resources\FiscalYears\Schemas\FiscalYearForm;
use JeffersonGoncalves\FilamentErp\Core\Resources\FiscalYears\Tables\FiscalYearsTable;

class FiscalYearResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?int $navigationSort = 4;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::fiscalYear();
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
        return FiscalYearForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return FiscalYearsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFiscalYears::route('/'),
            'create' => CreateFiscalYear::route('/create'),
            'edit' => EditFiscalYear::route('/{record}/edit'),
        ];
    }
}
