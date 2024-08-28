<?php

namespace App\Filament\Resources\InventoryIssueResource\Pages;

use App\Filament\Resources\InventoryIssueResource;
use App\Models\Inventory;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateInventoryIssue extends CreateRecord
{
    protected static string $resource = InventoryIssueResource::class;

    public $inventory_id;

    public function mount(): void
    {
        parent::mount();

        // Get the inventory_id from the URL
        $this->inventory_id = request()->query('inventory_id');

        // Optionally set the default value for the form field
        $this->form->fill([
            'inventory_id' => $this->inventory_id,
        ]);
    }

    protected function afterCreate(): void
    {
        $inventory = Inventory::find($this->inventory_id);
        $quantity = $this->form->getState()['quantity'];
        if ($inventory->quantity > 0) {
            $inventory->quantity = $inventory->quantity - $quantity;
            $inventory->save();
        }

        // event(new BookIssued($this->record));
    }
}
