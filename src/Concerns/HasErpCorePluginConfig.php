<?php

namespace JeffersonGoncalves\FilamentErp\Core\Concerns;

trait HasErpCorePluginConfig
{
    use HasErpPluginConfig;

    protected function getConfigKey(): string
    {
        return 'filament-erp-core';
    }

    protected function getDefaultNavigationGroup(): string
    {
        return 'ERP — Core';
    }
}
