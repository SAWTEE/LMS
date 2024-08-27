<?php

namespace App\Filament\Resources\InventoryIssueResource\Pages;

use App\Filament\Resources\InventoryIssueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInventoryIssue extends EditRecord
{
    protected static string $resource = InventoryIssueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
