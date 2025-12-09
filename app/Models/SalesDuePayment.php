<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDuePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'amount_paid',
        'payment_type',
        'cheque_number',  
        'cheque_date', 
    ];


}