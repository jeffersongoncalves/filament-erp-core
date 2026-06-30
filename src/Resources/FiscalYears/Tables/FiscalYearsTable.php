<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\FiscalYears\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class FiscalYearsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('year_start_date')
                    ->label('Start')
                    ->date()
                    ->sortable(),
                TextColumn::make('year_end_date')
                    ->label('End')
                    ->date()
                    ->sortable(),
                IconColumn::make('is_short_year')
                    ->label('Short Year')
                    ->boolean(),
            ])
            ->defaultSort('year_start_date', 'desc')
            ->filters([
                TernaryFilter::make('is_short_year')
                    ->label('Is Short Year'),
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
