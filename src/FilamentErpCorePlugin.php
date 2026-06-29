<?php

namespace JeffersonGoncalves\FilamentErp\Core;

use Filament\Contracts\Plugin;
use Filament\Panel;
use JeffersonGoncalves\FilamentErp\Core\Concerns\HasErpCorePluginConfig;
use JeffersonGoncalves\FilamentErp\Core\Resources\Brands\BrandResource;
use JeffersonGoncalves\FilamentErp\Core\Resources\Companies\CompanyResource;
use JeffersonGoncalves\FilamentErp\Core\Resources\Currencies\CurrencyResource;
use JeffersonGoncalves\FilamentErp\Core\Resources\Departments\DepartmentResource;
use JeffersonGoncalves\FilamentErp\Core\Resources\Designations\DesignationResource;
use JeffersonGoncalves\FilamentErp\Core\Resources\FiscalYears\FiscalYearResource;
use JeffersonGoncalves\FilamentErp\Core\Resources\TermsAndConditions\TermsAndConditionsResource;
use JeffersonGoncalves\FilamentErp\Core\Resources\Uoms\UomResource;

class FilamentErpCorePlugin implements Plugin
{
    use HasErpCorePluginConfig;

    public function getId(): string
    {
        return 'filament-erp-core';
    }

    public function register(Panel $panel): void
    {
        $panel->resources($this->resolveResources([
            'company' => CompanyResource::class,
            'currency' => CurrencyResource::class,
            'uom' => UomResource::class,
            'fiscal_year' => FiscalYearResource::class,
            'department' => DepartmentResource::class,
            'designation' => DesignationResource::class,
            'brand' => BrandResource::class,
            'terms_and_conditions' => TermsAndConditionsResource::class,
        ]));

        $panel->widgets($this->resolveWidgets());
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
