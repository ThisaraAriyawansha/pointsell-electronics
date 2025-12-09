<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{
    protected $fillable = ['name'];

    public function mobileItems()
    {
        return $this->hasMany(MobileItem::class);
    }
}