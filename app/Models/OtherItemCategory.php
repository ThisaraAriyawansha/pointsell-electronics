<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherItemCategory extends Model
{
    use HasFactory;

    protected $table = 'otherItem_categories';
    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(OtherItem::class, 'otherItem_category_id');
    }
}
