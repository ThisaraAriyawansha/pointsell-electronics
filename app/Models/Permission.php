<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;


    protected $fillable = [
        'permissions_name',
    ];

    public function roles()
{
    return $this->belongsToMany(Role::class, 'roles_has_permission', 'permissions_id', 'roles_id');
}

}