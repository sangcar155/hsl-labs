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
        $payload = $request->validated();

        try {
            $order = $this->orderService->createOrder($payload);

            return response()->json([
                'message' => 'Order placed successfully!',
                'data' => $order
            ], 201);

        } catch (InsufficientStockException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 409);
        } catch (\Exception $e) {
            // Keep generic error for unexpected issues
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
