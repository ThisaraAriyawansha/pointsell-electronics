<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock_update extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'items_id',
        'stock',
        'status',
        'note',
    ];

    // Enable timestamps (created_at and updated_at)
    public $timestamps = true;
}