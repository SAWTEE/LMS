<?php

namespace App\Filament\Widgets;

use App\Models\InventoryIssue;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestInventoryIssues extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(fn() => InventoryIssue::query()->latest())
            ->columns([
                TextColumn::make('inventory.item_name'),
                TextColumn::make('employee.name'),
                TextColumn::make('issue_date'),
                TextColumn::make('return_date'),
            ]);
    }
}
