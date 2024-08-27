<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventory_id',
        'employee_id',
        'quantity',
        'returnable',
        'issue_date',
        'return_date',
        'remarks',
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
