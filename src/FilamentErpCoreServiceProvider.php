<?php

namespace JeffersonGoncalves\FilamentErp\Core;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentErpCoreServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-erp-core';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasTranslations();
    }
}
