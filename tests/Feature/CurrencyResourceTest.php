<?php

use JeffersonGoncalves\Erp\Core\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Core\Resources\Currencies\Pages\CreateCurrency;
use JeffersonGoncalves\FilamentErp\Core\Resources\Currencies\Pages\EditCurrency;
use JeffersonGoncalves\FilamentErp\Core\Resources\Currencies\Pages\ListCurrencies;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the currency list page', function () {
    Livewire::test(ListCurrencies::class)->assertSuccessful();
});

it('can list currencies in the table', function () {
    $currency = ModelResolver::currency()::create([
        'code' => 'EUR',
        'name' => 'Euro',
        'symbol' => '€',
        'enabled' => true,
    ]);

    Livewire::test(ListCurrencies::class)
        ->assertCanSeeTableRecords([$currency]);
});

it('can create a currency', function () {
    Livewire::test(CreateCurrency::class)
        ->fillForm([
            'code' => 'GBP',
            'name' => 'Pound Sterling',
            'symbol' => '£',
            'fraction' => 'Penny',
            'fraction_units' => 100,
            'number_format' => '#,###.##',
            'enabled' => true,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(ModelResolver::currency()::query()->where('code', 'GBP')->exists())->toBeTrue();
});

it('can edit a currency', function () {
    $currency = ModelResolver::currency()::create([
        'code' => 'JPY',
        'name' => 'Yen',
        'enabled' => true,
    ]);

    Livewire::test(EditCurrency::class, ['record' => $currency->getRouteKey()])
        ->assertSuccessful()
        ->fillForm(['name' => 'Japanese Yen'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($currency->refresh()->name)->toBe('Japanese Yen');
});
