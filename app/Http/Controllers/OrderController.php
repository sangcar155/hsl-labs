<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Provider;
use App\Models\Patient;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    

    public function store(OrderRequest $request): JsonResponse
    {
        // basic inline authorization: ensure caller is a provider.
        // If you have auth, use $request->user() and roles.
        // For now, we rely on provider_id being passed and seeded data.
        $payload = $request->validated();

        try {
            $order = $this->orderService->createOrder($payload);
            return response()->json([
                'message' => 'Order placed successfully!',
                'data' => $order
            ], 201);
        } catch (\Exception $e) {
            // return 400 for business errors, 500 otherwise
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
