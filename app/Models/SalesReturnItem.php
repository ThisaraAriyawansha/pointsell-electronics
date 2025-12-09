<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReturnItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'sales_id',
        'return_quantity',
        'status',
    ];

    // Define relationships
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sales_id');
    }
    

}