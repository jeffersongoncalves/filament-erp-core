<?php

use JeffersonGoncalves\Erp\Core\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Core\Resources\Uoms\Pages\CreateUom;
use JeffersonGoncalves\FilamentErp\Core\Resources\Uoms\Pages\ListUoms;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));
});

it('can render the uom list page', function () {
    Livewire::test(ListUoms::class)->assertSuccessful();
});

it('can list units of measure in the table', function () {
    $uom = ModelResolver::uom()::create([
        'name' => 'Box',
        'enabled' => true,
        'must_be_whole_number' => true,
    ]);

    Livewire::test(ListUoms::class)
        ->assertCanSeeTableRecords([$uom]);
});

it('can create a unit of measure', function () {
    Livewire::test(CreateUom::class)
        ->fillForm([
            'name' => 'Kilogram',
            'enabled' => true,
            'must_be_whole_number' => false,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(ModelResolver::uom()::query()->where('name', 'Kilogram')->exists())->toBeTrue();
});
