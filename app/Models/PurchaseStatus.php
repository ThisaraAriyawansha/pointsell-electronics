<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseStatus extends Model
{
    protected $table = 'purchase_status';  // Define the correct table name

    protected $fillable = ['name'];

    public function mobileItems()
    {
        return $this->hasMany(MobileItem::class);
    }
}
