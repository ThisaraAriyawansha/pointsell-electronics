<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherItemType extends Model
{
    use HasFactory;

    protected $table = 'otherItem_types';
    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(OtherItem::class, 'otherItem_type_id');
    }
}
