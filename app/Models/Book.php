<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $cast = 'is_issued';

    protected $table = 'books';

    protected $fillable = [
        'title',
        'book_call_number',
        'author',
        'isbn',
        'is_issued',
        'book_category_id',
        'shelf_id',
        'publisher',
        'published_year',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(BookCategory::class, 'book_category_id');
    }

    public function shelf(): BelongsTo
    {
        return $this->belongsTo(Shelf::class, 'shelf_id');
    }

    public function issues()
    {
        return $this->hasMany(BookIssue::class);
    }

    public function isIssued()
    {
        return $this->is_issued;
    }
}
