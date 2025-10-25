<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'patients';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    /**
     * Relationships
     */

    // A patient can have many subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // A patient can have many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
