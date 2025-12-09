<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number', 'mobile_imei_id', 'name', 'email', 'number', 'address'
    ];

    // Relationship with MobileImei
    public function mobileImei()
    {
        return $this->belongsTo(MobileImei::class);
    }
}
