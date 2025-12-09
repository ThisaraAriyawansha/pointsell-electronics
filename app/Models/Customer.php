<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name', 
        'contact_number', 
        'address_line_1', 
        'address_line_2', 
        'customer_id', 
        'due_amount', 
        'cities_id', 
        'city_name', // New column
        'status_id', 
        'email', 
        'created_at', 
        'updated_at',
        'user_id',
    ];
    
}