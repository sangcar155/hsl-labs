<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'inventories';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'product_name',
        'quantity',
        'price',
    ];

    /**
     * Relationships
     */

    // Each inventory item may belong to many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Each inventory item can be part of many subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
