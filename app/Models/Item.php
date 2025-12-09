<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    static public function getSingle($id)
    {
        return self::find($id);
    }
    public function getImageUrlAttribute()
    {
        if (!empty($this->image_path) && file_exists(public_path('upload/item/' . $this->image_path))) {
            return asset('upload/item/' . $this->image_path);
        }

        return asset('upload/item/default.png'); // Default image
    }
    
    use HasFactory;

    protected $fillable = [
        'item_code',
        'item_name',
        'suppliers_id',
        'quantity',
        'minimum_qty',
        'purchase_price',
        'retail_price',
        'wholesale_price',
        'image_path',
        'status_id',
        'start_qty',
        'item_category_id'
    ];
    public function salesReturnItems()
    {
        return $this->hasMany(SalesReturnItem::class, 'item_id');
    }

    public function salesItems()
        {
            return $this->hasMany(Sales_item::class, 'items_id');
        }

   
}
