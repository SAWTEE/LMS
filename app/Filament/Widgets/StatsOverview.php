<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\BookIssue;
use App\Models\Contact;
use App\Models\InventoryIssue;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Books', Book::count())->description('Total book count in the library'),
            Stat::make('Contacts', Contact::count())->description('Total contact count in the address book'),
            Stat::make('Book Issues', BookIssue::count())->description('Total book issued from library'),
            Stat::make('Inventory Issues', InventoryIssue::count())->description('Total inventory issued from library'),
        ];
    }
}
