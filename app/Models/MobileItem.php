<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MobileItem extends Model
{
    protected $fillable = [
        'name', 'brand_id', 'model_id', 'description', 'color_id', 'storage_id', 'ram_id',
        'distributor_id', 'distributor_price', 'dealer_id', 'dealer_price', 'agent_id',
        'agent_price', 'tax', 'mrp_price', 'purchase_price', 'image_path', 'status_id',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function model()
    {
        return $this->belongsTo(Modell::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function storage()
    {
        return $this->belongsTo(Storage::class);
    }

    public function ram()
    {
        return $this->belongsTo(Ram::class);
    }

    public function distributor()
    {
        return $this->belongsTo(Distributor::class);
    }

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function purchaseStatus()
    {
        return $this->belongsTo(PurchaseStatus::class);
    }

    public function imeis()
    {
        return $this->hasMany(MobileImei::class);
    }


}