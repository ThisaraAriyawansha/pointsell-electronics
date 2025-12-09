<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense_categorie extends Model
{
    static public function getSingle($id)
    {
        return self::find($id);
    }
    use HasFactory;
    protected $table = 'expense_categories';
    protected $fillable = [
        'name',
        'user_id',
    ];
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'expense_categories_id');
    }
}
