<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\TermsAndConditions\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TermsAndConditionsForm
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
                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
