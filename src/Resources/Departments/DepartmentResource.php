<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Departments;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use JeffersonGoncalves\Erp\Core\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Core\FilamentErpCorePlugin;
use JeffersonGoncalves\FilamentErp\Core\Resources\Departments\Pages\CreateDepartment;
use JeffersonGoncalves\FilamentErp\Core\Resources\Departments\Pages\EditDepartment;
use JeffersonGoncalves\FilamentErp\Core\Resources\Departments\Pages\ListDepartments;
use JeffersonGoncalves\FilamentErp\Core\Resources\Departments\Schemas\DepartmentForm;
use JeffersonGoncalves\FilamentErp\Core\Resources\Departments\Tables\DepartmentsTable;

class DepartmentResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?int $navigationSort = 5;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getModel(): string
    {
        return ModelResolver::department();
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
        return DepartmentForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return DepartmentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDepartments::route('/'),
            'create' => CreateDepartment::route('/create'),
            'edit' => EditDepartment::route('/{record}/edit'),
        ];
    }
}
