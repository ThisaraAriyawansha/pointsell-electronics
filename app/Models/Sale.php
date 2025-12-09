<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_code',//randomcode IM
        'customers_id',
        'users_id', //1
        'warranty_period', //
        'warranty_card_no', //
    ];

    public function salesItems()
{
    return $this->hasMany(Sales_item::class, 'sales_id');
}

public function payment()
{
    return $this->hasOne(Payment::class, 'sales_id');
}
public function customer()
    {
        return $this->belongsTo(Customer::class, 'customers_id'); // customers_id is the foreign key
    }
    public function salesReturnItems()
{
    return $this->hasMany(SalesReturnItem::class, 'sales_id');
}

public function sales()
{
    return $this->hasManyThrough(Sale::class, Sales_item::class, 'items_id', 'id', 'id', 'sales_id');
}

}
