<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Inventory;
use App\Events\OrderPlaced;
use App\Exceptions\InsufficientStockException;
use Illuminate\Support\Facades\DB;
use Exception;

class OrderService
{
    /**
     * Create an order safely using a DB transaction and pessimistic locking.
     *
     * @param array $data
     * @return \App\Models\Order
     *
     * @throws InsufficientStockException
     */
    public function createOrder(array $data): Order
    {
        // return value from DB::transaction closure will be returned and transaction committed
        return DB::transaction(function () use ($data) {

            // Acquire pessimistic lock on the inventory row
            /** @var Inventory $inventory */
            $inventory = Inventory::where('id', $data['inventory_id'])
                ->lockForUpdate()
                ->first();

            if (! $inventory) {
                throw new Exception('Inventory item not found.');
            }

            // Validate stock after obtaining lock
            if ($inventory->quantity < $data['quantity']) {
                // throw a specific exception so controller can return 409
                throw new InsufficientStockException("Requested quantity ({$data['quantity']}) exceeds available stock ({$inventory->quantity}).");
            }

            // Calculate total (adjust as your domain requires)
            $total = $inventory->price * $data['quantity'];

            // Create the order
            $order = Order::create([
                'provider_id'  => $data['provider_id'],
                'patient_id'   => $data['patient_id'] ?? null,
                'inventory_id' => $inventory->id,
                'quantity'     => $data['quantity'],
                'total'        => $total,
                'status'       => $data['status'] ?? 'confirmed',
            ]);

            // Decrement inventory (still within same transaction & row lock)
            $inventory->decrement('quantity', $data['quantity']);

            // Optionally reload relationships
            $order->load(['provider', 'inventory', 'patient']);

            // Fire event (you can also dispatch after commit if preferred)
            event(new OrderPlaced($order));

            return $order;
        });
    }
}
