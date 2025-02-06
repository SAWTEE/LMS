<?php

namespace App\Filament\Resources\BookIssueResource\Pages;

use App\Filament\Resources\BookIssueResource;
use App\Models\Book;
use App\Models\BookIssue;
use Filament\Notifications\Notification;
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
        $queryHasBookId = request()->query('book_id') !== null;
        if ($queryHasBookId) {
            $book = Book::find($this->book_id);
        }
        $latestIssuedBook = BookIssue::latest()->first();
        $book = Book::find($latestIssuedBook->book_id);
        $book->update(['is_issued' => 1]);

        Notification::make()->title('Book Issued Successfully')->success()->send();

    //     // event(new BookIssued($this->record));
    }
}
