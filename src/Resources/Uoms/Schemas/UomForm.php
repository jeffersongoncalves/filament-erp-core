<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Uoms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(null)
            ->components([
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
