<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modell extends Model
{
    protected $fillable = ['name'];

    public function mobileItems()
    {
        return $this->hasMany(MobileItem::class);
    }
}