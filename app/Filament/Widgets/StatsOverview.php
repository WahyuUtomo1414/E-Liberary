<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {

        return [
            Stat::make('Kategori Buku', 14)
                ->description('Kategori')
                ->descriptionIcon('heroicon-m-bookmark')
                ->chart([2, 3, 35, 18, 15, 26, 15, 30, 25, 30, 25, 50])
                ->color('info'),
            Stat::make('Buku', 122)
                ->description('Buku')
                ->descriptionIcon('heroicon-m-book-open')
                ->chart([32, 23, 35, 18, 15, 56, 15, 30, 25, 30, 25, 30])
                ->color('warning'),
            Stat::make('Buku Dipinjam', 43)
                ->description('Dipinjam')
                ->descriptionIcon('heroicon-m-arrow-down-on-square')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
