<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Currencies\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CurrenciesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('symbol')
                    ->toggleable(),
                TextColumn::make('fraction')
                    ->toggleable(isToggledHiddenByDefault: true),
                ToggleColumn::make('enabled'),
            ])
            ->defaultSort('code')
            ->filters([
                TernaryFilter::make('enabled'),
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
