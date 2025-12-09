<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherItem extends Model
{
    use HasFactory;

    protected $table = 'other_item';
    protected $fillable = [
        'name', 'otherItem_brand_id', 'otherItem_category_id', 
        'otherItem_type_id', 'image_path', 'status_id', 
        'purchase_price', 'retail_price', 'wholesale_price'
    ];

    public function brand()
    {
        return $this->belongsTo(OtherItemBrand::class, 'otherItem_brand_id');
    }

    public function category()
    {
        return $this->belongsTo(OtherItemCategory::class, 'otherItem_category_id');
    }

    public function type()
    {
        return $this->belongsTo(OtherItemType::class, 'otherItem_type_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function serialNumbers()
    {
        return $this->hasMany(SerialNumber::class, 'otherItem_id');
    }

}
