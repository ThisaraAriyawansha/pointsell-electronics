<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_id ',
        'users_id ',
        'sub_total',
        'grand_total',
        'paid_amount',
        'due_amount',
        'discount_type',
        'cheque_no',
        'cheque_date',
        'discount',
        'payment_type',
        'payment_status',
        'sales_note',
        'pay_due_amount', 
    ];

    public function sale()
{
    return $this->belongsTo(Sale::class, 'sales_id');
}
public function user()
{
    return $this->belongsTo(User::class, 'users_id');
}
}