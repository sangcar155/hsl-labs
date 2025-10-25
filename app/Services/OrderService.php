<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Inventory;
use Exception;

class OrderService
{
    /**
     * Create a new order and update inventory.
     *
     * @param array $data
     * @return \App\Models\Order
     * @throws \Exception
     */
    public function createOrder(array $data)
    {
        return DB::transaction(function () use ($data) {

            $inventory = Inventory::findOrFail($data['inventory_id']);

            if ($inventory->quantity < $data['quantity']) {
                throw new Exception('Not enough stock available.');
            }

            // Calculate total
            $total = $inventory->price * $data['quantity'];

            // Create order
            $order = Order::create([
                'provider_id' => $data['provider_id'],
                'patient_id' => $data['patient_id'] ?? null,
                'inventory_id' => $inventory->id,
                'quantity' => $data['quantity'],
                'total' => $total,
                'status' => 'confirmed',
            ]);

            // Decrease inventory
            $inventory->decrement('quantity', $data['quantity']);

            return $order->load(['provider', 'inventory', 'patient']);
        });
    }
}
