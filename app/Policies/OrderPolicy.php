<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;
use App\Models\Provider;

class OrderPolicy
{
    /**
     * Determine whether the user can create an order for the given provider.
     */
    public function create(User $user, Provider $provider): bool
    {
        // Only the provider who owns the user account can create an order.
        return $user->id === $provider->user_id;
    }

    /**
     * Determine whether the user can view the order.
     */
    public function view(User $user, Order $order): bool
    {
        return $user->id === $order->provider->user_id;
    }
}
