<?php

use JeffersonGoncalves\Erp\Core\Support\ModelResolver;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\Pages\EditCompany;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\RelationManagers\AddressRelationManager;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\RelationManagers\ContactRelationManager;
use Livewire\Livewire;

beforeEach(function () {
    filament()->setCurrentPanel(filament()->getPanel('admin'));

    $this->company = ModelResolver::company()::create([
        'name' => 'Acme Corp',
        'abbr' => 'ACME',
        'default_currency' => 'USD',
        'is_group' => false,
    ]);
});

it('can render the address relation manager', function () {
    $this->company->addresses()->create([
        'address_type' => 'Billing',
        'address_line1' => '123 Main St',
        'city' => 'Springfield',
        'country' => 'USA',
        'is_primary' => true,
    ]);

    Livewire::test(AddressRelationManager::class, [
        'ownerRecord' => $this->company,
        'pageClass' => EditCompany::class,
    ])
        ->assertSuccessful()
        ->assertCanSeeTableRecords($this->company->addresses);
});

it('can render the contact relation manager', function () {
    $this->company->contacts()->create([
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'email' => 'jane@example.com',
        'is_primary' => true,
    ]);

    Livewire::test(ContactRelationManager::class, [
        'ownerRecord' => $this->company,
        'pageClass' => EditCompany::class,
    ])
        ->assertSuccessful()
        ->assertCanSeeTableRecords($this->company->contacts);
});
