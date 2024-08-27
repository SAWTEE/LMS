<?php

namespace App\Filament\Resources\InventoryIssueResource\Pages;

use App\Filament\Resources\InventoryIssueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInventoryIssues extends ListRecords
{
    protected static string $resource = InventoryIssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
