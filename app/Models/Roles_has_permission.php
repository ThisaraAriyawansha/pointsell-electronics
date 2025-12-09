<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles_has_permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'roles_id',
        'permissions_id',
    ];

    public function role()
{
    return $this->belongsTo(Role::class, 'roles_id');
}

public function permission()
{
    return $this->belongsTo(Permission::class, 'permissions_id');
}

}