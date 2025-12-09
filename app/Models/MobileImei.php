<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobileImei extends Model
{
    protected $fillable = [
        'mobile_item_id', 'imei_number','purchase_status_id'
    ];

    // Relationship to MobileItem
    public function mobileItem()
    {
        return $this->belongsTo(MobileItem::class);
    }

    public function purchaseStatus()
    {
        return $this->belongsTo(PurchaseStatus::class, 'purchase_status_id');
    }

}