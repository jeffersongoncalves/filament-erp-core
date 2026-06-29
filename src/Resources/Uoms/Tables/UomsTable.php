<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Uoms\Tables;

use Filament\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class UomsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                IconColumn::make('must_be_whole_number')
                    ->label('Whole Number')
                    ->boolean(),
                ToggleColumn::make('enabled'),
            ])
            ->defaultSort('name')
            ->filters([
                TernaryFilter::make('enabled'),
                TernaryFilter::make('must_be_whole_number')
                    ->label('Must Be Whole Number'),
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
