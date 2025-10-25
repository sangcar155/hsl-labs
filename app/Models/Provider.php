<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'clinic_name'];

    // One provider can place many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
 
}
