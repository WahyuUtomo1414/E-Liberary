<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {

        return [
            Stat::make('All Customer', 122)
                ->description('Customer')
                ->descriptionIcon('heroicon-m-user')
                ->chart([2, 3, 35, 18, 15, 26, 15, 30, 25, 30, 25, 50])
                ->color('info'),
            Stat::make('All Orders', 122)
                ->description('Orders')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->chart([32, 23, 35, 18, 15, 56, 15, 30, 25, 30, 25, 30])
                ->color('warning'),
            Stat::make('Amount Revenue', 122)
                ->description('Revenue')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
