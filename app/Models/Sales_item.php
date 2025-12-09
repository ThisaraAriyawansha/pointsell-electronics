<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'items_id',
        'sales_id',
        'quantity',
        'discount_type',
        'discount',
        'return_quantity', // 'permanent' : 'non-permanent'
        'status',
    ];

    public function sale()
{
    return $this->belongsTo(Sale::class, 'sales_id');
}
public function item()
{
    return $this->belongsTo(Item::class, 'items_id');
}
}

