<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Resources\Pages\Page;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class GridViewContacts extends Page
{
    protected static string $resource = ContactResource::class;

    protected static string $view = 'filament.resources.contact-resource.pages.grid-view-contacts';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
