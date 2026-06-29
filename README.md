<div class="filament-hidden">

![Filament ERP Core](https://raw.githubusercontent.com/jeffersongoncalves/filament-erp-core/3.x/art/jeffersongoncalves-filament-erp-core.png)

</div>

# Filament ERP Core

Filament v5 panel resources for the [Laravel ERP core](https://github.com/jeffersongoncalves/laravel-erp-core) — companies, currencies, units of measure, fiscal years and the organizational masters.

This package is the UI layer for the `jeffersongoncalves/laravel-erp-core` domain package (namespace `JeffersonGoncalves\Erp\Core\`). It is the reference UI package that every other `filament-erp-*` package is cloned from, wiring the core master-data models into ready-to-use Filament resources, relation managers and dashboard widgets.

## Features

- **Master-data resources** — Companies, currencies, units of measure, fiscal years, departments, designations, brands and terms & conditions
- **Relation managers** — Manage polymorphic addresses and contacts directly from the Company resource
- **Dashboard widget** — `ErpCoreStatsWidget` with counts of companies, enabled currencies and departments
- **Configurable** — Swap resource classes, change the navigation group or assign a cluster via config
- **Translations** — English and Brazilian Portuguese, inherited from the domain package

## Compatibility

| Package | PHP | Filament | Laravel |
|---------|-----|----------|---------|
| `^3.0`  | `^8.2` | `^5.0` | `^11.0 \| ^12.0 \| ^13.0` |

## Installation

Install the package via Composer:

```bash
composer require jeffersongoncalves/filament-erp-core
```

Register the plugin on a Filament panel:

```php
use JeffersonGoncalves\FilamentErp\Core\FilamentErpCorePlugin;

$panel->plugin(
    FilamentErpCorePlugin::make()
        ->navigationGroup('ERP — Core'),
);
```

## Resources

| Resource | Master |
|----------|--------|
| `CompanyResource` | Companies (with Address & Contact relation managers) |
| `CurrencyResource` | Currencies |
| `UomResource` | Units of measure |
| `FiscalYearResource` | Fiscal years |
| `DepartmentResource` | Departments |
| `DesignationResource` | Designations |
| `BrandResource` | Brands |
| `TermsAndConditionsResource` | Terms & conditions |

A dashboard `ErpCoreStatsWidget` shows counts of companies, enabled currencies and departments.

## Configuration

Publish the config to swap resource classes, change the navigation group, or assign a cluster:

```bash
php artisan vendor:publish --tag="filament-erp-core-config"
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Jefferson Simão Gonçalves](https://github.com/jeffersongoncalves)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
