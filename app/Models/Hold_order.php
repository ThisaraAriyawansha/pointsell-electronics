<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hold_order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customers_id',
        'users_id',
        'hold_reference',
        'hold_status',
    ];
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customers_id');
    }

    // Relationship to a User model
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
    // Define the relationship
    public function items()
    {
        return $this->hasMany(Hold_order_item::class, 'hold_orders_id');
    }
}


