<?php

use JeffersonGoncalves\Erp\Core\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\Pages\CreateCompany;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\Pages\EditCompany;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\Pages\ListCompanies;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));

    ModelResolver::currency()::create([
        'code' => 'USD',
        'name' => 'US Dollar',
        'enabled' => true,
    ]);
});

it('can render the company list page', function () {
    Livewire::test(ListCompanies::class)->assertSuccessful();
});

it('can list companies in the table', function () {
    $company = ModelResolver::company()::create([
        'name' => 'Acme Corp',
        'abbr' => 'ACME',
        'default_currency' => 'USD',
        'is_group' => false,
    ]);

    Livewire::test(ListCompanies::class)
        ->assertCanSeeTableRecords([$company]);
});

it('can create a company', function () {
    Livewire::test(CreateCompany::class)
        ->fillForm([
            'name' => 'Globex',
            'abbr' => 'GLBX',
            'default_currency' => 'USD',
            'country' => 'Brazil',
            'is_group' => false,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(ModelResolver::company()::query()->where('abbr', 'GLBX')->exists())->toBeTrue();
});

it('can edit a company', function () {
    $company = ModelResolver::company()::create([
        'name' => 'Initech',
        'abbr' => 'INIT',
        'default_currency' => 'USD',
        'is_group' => false,
    ]);

    Livewire::test(EditCompany::class, ['record' => $company->getRouteKey()])
        ->assertSuccessful()
        ->fillForm(['name' => 'Initech Global'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($company->refresh()->name)->toBe('Initech Global');
});
