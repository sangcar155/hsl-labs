<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    /**
     * Determine whether the user can create an order.
     */
    public function create(User $user): bool
    {
        // Example: only users with role 'provider' can create orders
        return $user->role === 'provider';
    }

    /**
     * Determine whether the user can view the order.
     */
    public function view(User $user, Order $order): bool
    {
        return $user->id === $order->provider_id;
    }
}
