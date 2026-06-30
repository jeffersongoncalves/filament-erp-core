<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\FiscalYears\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;

class FiscalYearForm
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
                        Toggle::make('is_short_year')
                            ->label('Is Short Year')
                            ->default(false),
                        DatePicker::make('year_start_date')
                            ->label('Year Start Date')
                            ->required(),
                        DatePicker::make('year_end_date')
                            ->label('Year End Date')
                            ->required()
                            ->afterOrEqual('year_start_date'),
                    ])->columns(2),
            ]);
    }
}
