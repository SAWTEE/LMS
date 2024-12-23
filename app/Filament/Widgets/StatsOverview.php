<?php

namespace App\Filament\Widgets;

use App\Models\Book;

use App\Models\Contact;
use App\Models\Inventory;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Books', Book::count())->description('Total book count in the library')
            ->descriptionIcon('heroicon-o-book-open')->color('info'),
            Stat::make('Contacts', Contact::count())->description('Total contact count in the address book')->descriptionIcon('heroicon-s-users')->color('info'),
            Stat::make('Inventories', Inventory::count())->description('Total inventory count')->descriptionIcon('heroicon-s-inbox-stack')->color('info'),
        ];
    }
}
