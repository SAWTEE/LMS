<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'item_name',
        'quantity',
        'item_category',
        'in_stock',
        'remarks',
    ];

    public function inventoryIssues()
    {
        return $this->hasMany(InventoryIssue::class);
    }
}
