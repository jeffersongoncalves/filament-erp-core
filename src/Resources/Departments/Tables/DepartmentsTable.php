<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Departments\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class DepartmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('company.name')
                    ->label('Company')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('parent.name')
                    ->label('Parent')
                    ->sortable()
                    ->toggleable(),
                IconColumn::make('is_group')
                    ->label('Is Group')
                    ->boolean(),
            ])
            ->defaultSort('name')
            ->filters([
                TernaryFilter::make('is_group')
                    ->label('Is Group'),
            ])
            ->actions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
