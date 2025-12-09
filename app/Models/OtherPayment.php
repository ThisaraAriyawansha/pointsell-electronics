<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPayment extends Model
{
    use HasFactory;

    protected $table = 'Other_Payment';

    protected $fillable = [
        'invoice_num',
        'customer_id',
        'total',
        'payment_type',
        'warranty'
    ];

    public function orders()
    {
        return $this->hasMany(OtherOrder::class, 'other_payment_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
