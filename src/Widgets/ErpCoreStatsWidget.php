<?php

namespace JeffersonGoncalves\FilamentErp\Core\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use JeffersonGoncalves\Erp\Core\Support\ModelResolver;

class ErpCoreStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $companyModel = ModelResolver::company();
        $currencyModel = ModelResolver::currency();
        $departmentModel = ModelResolver::department();

        return [
            Stat::make('Companies', $companyModel::count()),
            Stat::make('Currencies', $currencyModel::where('enabled', true)->count())
                ->description('Enabled currencies')
                ->color('success'),
            Stat::make('Departments', $departmentModel::count()),
        ];
    }
}
