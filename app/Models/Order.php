<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class Order extends Model
{
    use HasFactory;

   protected $fillable = [
        'provider_id',
        'patient_id',
        'inventory_id',   // ✅ make sure this is here
        'quantity',
        'total',
        'status',
    ];

    // ✅ Each order belongs to one provider
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    // ✅ Each order has many order items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function patient()
{
    return $this->belongsTo(Patient::class);
}
public function inventory()
{
    return $this->belongsTo(Inventory::class);
}


}
