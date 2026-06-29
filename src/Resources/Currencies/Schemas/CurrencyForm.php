<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Currencies\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;

class CurrencyForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        TextInput::make('code')
                            ->required()
                            ->maxLength(3)
                            ->unique(ignoreRecord: true),
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('symbol')
                            ->maxLength(8),
                        TextInput::make('fraction')
                            ->maxLength(255),
                        TextInput::make('fraction_units')
                            ->label('Fraction Units')
                            ->numeric()
                            ->default(100),
                        TextInput::make('number_format')
                            ->label('Number Format')
                            ->placeholder('#,###.##')
                            ->maxLength(255),
                        Toggle::make('enabled')
                            ->default(true),
                    ])->columns(2),
            ]);
    }
}
