<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
    ];


    public function permissions() {
        return $this->belongsToMany(Permission::class, 'roles_has_permissions', 'roles_id', 'permissions_id');
    }
    
    public function users()
    {
        return $this->hasMany(User::class, 'roles_id');
    }




}