<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Uoms\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;

class UomForm
{
    public static function configure(Form $form): Form
    {
        return $form
            ->columns(null)
            ->schema([
                Section::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Toggle::make('enabled')
                            ->default(true),
                        Toggle::make('must_be_whole_number')
                            ->label('Must Be Whole Number')
                            ->default(false),
                    ])->columns(2),
            ]);
    }
}
