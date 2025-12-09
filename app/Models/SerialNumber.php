<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialNumber extends Model
{
    use HasFactory;

    protected $table = 'serial_numbers';
    protected $fillable = ['serial_number', 'otherItem_id', 'purchase_status_id'];

    public function item()
    {
        return $this->belongsTo(OtherItem::class, 'otherItem_id');
    }

    public function purchaseStatus()
    {
        return $this->belongsTo(PurchaseStatus::class, 'purchase_status_id');
    }
}
