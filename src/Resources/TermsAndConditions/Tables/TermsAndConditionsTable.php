<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\TermsAndConditions\Tables;

use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TermsAndConditionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->defaultSort('name')
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
