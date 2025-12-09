<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hold_order_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'items_id',
        'hold_orders_id',
        'quantity',
        'discount_type',
        'discount',
    ];
}

