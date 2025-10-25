<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'provider_id',
        'total_amount',
        'status',
        'notes',
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
