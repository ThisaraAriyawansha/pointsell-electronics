<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'site_settings';

    // The attributes that are mass assignable
    protected $fillable = [
        'site_name',
        'sidebar_one_name',
        'sidebar_two_name',
        'contact_number',
        'company_logo',
    ];

    // Optional: Specify any attributes to cast
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}