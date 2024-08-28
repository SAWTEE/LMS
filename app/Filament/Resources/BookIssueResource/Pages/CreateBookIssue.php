<?php

namespace App\Filament\Resources\BookIssueResource\Pages;

use App\Events\BookIssued;
use App\Filament\Resources\BookIssueResource;
use App\Models\Book;
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

    protected function afterCreate(): void
    {
        $book = Book::find($this->book_id);
        if ($book->book_count > 0) {
            $book->book_count = $book->book_count - 1;
            $book->save();
        }

        // event(new BookIssued($this->record));
    }
}
