<?php

use JeffersonGoncalves\FilamentErp\Core\Resources\Brands\BrandResource;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\CompanyResource;
use JeffersonGoncalves\FilamentErp\Core\Resources\Currencies\CurrencyResource;
use JeffersonGoncalves\FilamentErp\Core\Resources\Departments\DepartmentResource;
use JeffersonGoncalves\FilamentErp\Core\Resources\Designations\DesignationResource;
use JeffersonGoncalves\FilamentErp\Core\Resources\FiscalYears\FiscalYearResource;
use JeffersonGoncalves\FilamentErp\Core\Resources\TermsAndConditions\TermsAndConditionsResource;
use JeffersonGoncalves\FilamentErp\Core\Resources\Uoms\UomResource;
use JeffersonGoncalves\FilamentErp\Core\Widgets\ErpCoreStatsWidget;

return [

    /*
    |--------------------------------------------------------------------------
    | Navigation Group
    |--------------------------------------------------------------------------
    |
    | The navigation group under which all ERP core resources are listed in
    | the Filament panel. Override per-plugin with ->navigationGroup('...').
    |
    */

    'navigation_group' => 'ERP — Core',

    /*
    |--------------------------------------------------------------------------
    | Cluster
    |--------------------------------------------------------------------------
    |
    | Optionally group all resources under a Filament cluster. Set to a cluster
    | class-string to enable, or null to register resources at the top level.
    |
    */

    'cluster' => null,

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    |
    | The Filament resource classes registered by the plugin. Each entry can be
    | swapped for a custom resource extending the default one.
    |
    */

    'resources' => [
        'company' => CompanyResource::class,
        'currency' => CurrencyResource::class,
        'uom' => UomResource::class,
        'fiscal_year' => FiscalYearResource::class,
        'department' => DepartmentResource::class,
        'designation' => DesignationResource::class,
        'brand' => BrandResource::class,
        'terms_and_conditions' => TermsAndConditionsResource::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    |
    | The Filament widgets registered by the plugin on the panel dashboard.
    |
    */

    'widgets' => [
        'stats' => ErpCoreStatsWidget::class,
    ],

];
