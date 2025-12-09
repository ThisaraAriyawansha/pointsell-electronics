<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'expense_title',
        'details',
        'expense_date',
        'amount',
        'expense_categories_id',
        'user_id',
    ];
    public function category()
    {
        return $this->belongsTo(Expense_categorie::class, 'expense_categories_id');
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
    protected $casts = [
        'expense_date' => 'date',
    ];
    
}
