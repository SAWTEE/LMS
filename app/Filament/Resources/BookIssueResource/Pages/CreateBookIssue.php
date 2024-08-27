<?php

namespace App\Filament\Resources\BookIssueResource\Pages;

use App\Filament\Resources\BookIssueResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBookIssue extends CreateRecord
{
    protected static string $resource = BookIssueResource::class;

    public $book_id;

    public function mount(): void
    {
        parent::mount();

        // Get the book_id from the URL
        $this->book_id = request()->query('book_id');

        // Optionally set the default value for the form field
        $this->form->fill([
            'book_id' => $this->book_id,
        ]);
    }
}
