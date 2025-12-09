<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherOrder extends Model
{
    use HasFactory;

    protected $table = 'Other_Order';

    protected $fillable = [
        'other_payment_id',
        'serial_number_id'
    ];

    public function payment()
    {
        return $this->belongsTo(OtherPayment::class, 'other_payment_id');
    }

    public function unit()
    {
        return $this->belongsTo(SerialNumber::class, 'serial_number_id');
    }

    // Unit.php
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
