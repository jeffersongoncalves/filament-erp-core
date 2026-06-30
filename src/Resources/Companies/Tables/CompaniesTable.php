<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Companies\Tables;

use Filament\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CompaniesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('abbr')
                    ->label('Abbreviation')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('default_currency')
                    ->label('Default Currency')
                    ->badge()
                    ->sortable(),
                TextColumn::make('country')
                    ->toggleable()
                    ->sortable(),
                IconColumn::make('is_group')
                    ->label('Is Group')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('name')
            ->filters([
                TernaryFilter::make('is_group')
                    ->label('Is Group'),
            ])
            ->recordActions([
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
