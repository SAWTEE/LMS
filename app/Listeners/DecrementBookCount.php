<?php

namespace App\Listeners;

use App\Events\BookIssued;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DecrementBookCount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookIssued $event): void
    {
        $book = $event->book;

        if ($book->book_count > 0) {
            $book->book_count = $book->book_count - 1;
            $book->save();
        }
    }
}
