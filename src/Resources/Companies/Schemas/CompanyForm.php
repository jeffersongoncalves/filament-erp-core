<?php

namespace JeffersonGoncalves\FilamentErp\Core\Resources\Companies\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use JeffersonGoncalves\Erp\Core\Support\ModelResolver;

class CompanyForm
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
                            ->maxLength(255),
                        TextInput::make('abbr')
                            ->label('Abbreviation')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Select::make('default_currency')
                            ->options(fn (): array => self::currencyOptions())
                            ->searchable()
                            ->required(),
                        TextInput::make('country')
                            ->maxLength(255),
                        TextInput::make('tax_id')
                            ->label('Tax ID')
                            ->maxLength(255),
                        Select::make('parent_company_id')
                            ->label('Parent Company')
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        Toggle::make('is_group')
                            ->label('Is Group')
                            ->default(false),
                    ])->columns(2),
            ]);
    }

    /** @return array<string, string> */
    protected static function currencyOptions(): array
    {
        $currency = ModelResolver::currency();

        return $currency::query()
            ->orderBy('code')
            ->pluck('name', 'code')
            ->all();
    }
}
