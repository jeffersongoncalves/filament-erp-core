<?php

it('loads the filament-erp-core config file', function () {
    expect(config('filament-erp-core'))->toBeArray();
});

it('has a default navigation group', function () {
    expect(config('filament-erp-core.navigation_group'))->toBe('ERP — Core');
});

it('registers all standalone resources in config', function () {
    $resources = config('filament-erp-core.resources');

    expect($resources)->toBeArray()
        ->toHaveKeys([
            'company',
            'currency',
            'uom',
            'fiscal_year',
            'department',
            'designation',
            'brand',
            'terms_and_conditions',
        ]);
});

it('registers the stats widget in config', function () {
    expect(config('filament-erp-core.widgets'))->toBeArray()
        ->toHaveKey('stats');
});
