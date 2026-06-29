<?php

namespace JeffersonGoncalves\FilamentErp\Core\Testing;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Composer\InstalledVersions;
use Filament\Actions\ActionsServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Schemas\SchemasServiceProvider;
use Filament\Support\Livewire\Partials\DataStoreOverride;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use Livewire\LivewireServiceProvider;
use Livewire\Mechanisms\DataStore;
use Orchestra\Testbench\TestCase;
use RyanChandler\BladeCaptureDirective\BladeCaptureDirectiveServiceProvider;

/**
 * Shared Filament test-harness helpers for the ERP module packages. Mix this
 * trait into a module's Orchestra Testbench {@see TestCase}
 * to reuse the Livewire DataStore rebind, the Filament provider list and the
 * foreign-key-safe ERP migration loader.
 *
 * @mixin TestCase
 */
trait InteractsWithErpFilament
{
    /**
     * Re-bind Livewire's DataStore as a shared singleton.
     *
     * Filament's SupportServiceProvider binds the DataStore to a transient
     * DataStoreOverride, which loses its WeakMap state between resolutions
     * during a single Livewire test render. Binding it as a shared singleton
     * keeps component state (e.g. the error bag) alive for the whole render.
     */
    protected function rebindFilamentDataStore(): void
    {
        if (! class_exists(DataStoreOverride::class) || ! class_exists(DataStore::class)) {
            return;
        }

        $this->app->singleton(DataStore::class, DataStoreOverride::class);
    }

    /**
     * The Livewire + Filament service providers required to boot a panel in a
     * package test, in dependency order.
     *
     * @return array<int, class-string>
     */
    protected function filamentTestProviders(): array
    {
        return [
            LivewireServiceProvider::class,
            BladeIconsServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            BladeCaptureDirectiveServiceProvider::class,
            SupportServiceProvider::class,
            FilamentServiceProvider::class,
            FormsServiceProvider::class,
            SchemasServiceProvider::class,
            TablesServiceProvider::class,
            ActionsServiceProvider::class,
            InfolistsServiceProvider::class,
            NotificationsServiceProvider::class,
            WidgetsServiceProvider::class,
        ];
    }

    /**
     * Copy the vendored `*.php.stub` migrations for the given ERP domain
     * packages into a single temp directory, each prefixed with a `%04d_`
     * counter so loadMigrationsFrom's filename sort preserves the global
     * foreign-key-safe order supplied by the caller.
     *
     * @param  array<string, list<string>>  $packages  map of laravel-erp-<suffix> package suffix => ordered migration names
     */
    protected function loadErpVendorMigrations(array $packages): void
    {
        $tempPath = sys_get_temp_dir().'/filament-erp-vendor-migrations-'.md5(serialize(array_keys($packages)));

        if (is_dir($tempPath)) {
            array_map('unlink', (array) glob($tempPath.'/*.php'));
        } else {
            mkdir($tempPath, 0755, true);
        }

        $index = 0;

        foreach ($packages as $package => $migrations) {
            $base = InstalledVersions::getInstallPath('jeffersongoncalves/laravel-erp-'.$package);

            if ($base === null) {
                $index += count($migrations);

                continue;
            }

            $migrationsPath = $base.'/database/migrations';

            foreach ($migrations as $name) {
                $stub = $migrationsPath.'/'.$name.'.php.stub';

                if (file_exists($stub)) {
                    copy($stub, sprintf('%s/%04d_%s.php', $tempPath, $index, $name));
                }

                $index++;
            }
        }

        $this->loadMigrationsFrom($tempPath);
    }

    /**
     * Build a factory-name resolver for Factory::guessFactoryNamesUsing that
     * tries each namespace in priority order and falls back to the last one.
     *
     * @param  list<string>  $namespaces  factory namespaces in priority order
     */
    protected function erpFactoryResolver(array $namespaces): callable
    {
        return function (string $modelName) use ($namespaces): string {
            $basename = class_basename($modelName);

            foreach ($namespaces as $namespace) {
                $factory = trim($namespace, '\\').'\\'.$basename.'Factory';

                if (class_exists($factory)) {
                    return $factory;
                }
            }

            $fallback = $namespaces === [] ? '' : trim($namespaces[array_key_last($namespaces)], '\\');

            return $fallback.'\\'.$basename.'Factory';
        };
    }
}
