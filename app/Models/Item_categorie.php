<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_categorie extends Model
{
    static public function getSingle($id)
    {
        return self::find($id);
    }
    use HasFactory;

    protected $fillable = [
        'categories',
        'description',
    ];
}
