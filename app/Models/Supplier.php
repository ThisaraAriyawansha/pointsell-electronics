<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_name',
        'contact_number',
        'email',
        'address',
        'user_id',
        'status_id',
        'city_id', 
        'city_name', 
    ];
    public function supplier()
{
    return $this->belongsTo(Supplier::class);
}

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}