<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherItemBrand extends Model
{
    use HasFactory;

    protected $table = 'otherItem_brands';
    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(OtherItem::class, 'otherItem_brand_id');
    }
}
