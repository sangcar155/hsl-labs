<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use App\Exceptions\InsufficientStockException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
class OrderController extends Controller
{
    use AuthorizesRequests;
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

   public function store(OrderRequest $request)
{
    // ✅ Extract validated payload
    $payload = $request->validated();

    // ✅ Authorization Check (Policy)
    $provider = \App\Models\Provider::findOrFail($payload['provider_id']);
    $this->authorize('create', [\App\Models\Order::class, $provider]);

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

        return response()->json([
            'message' => 'Something went wrong, please try again.'
        ], 500);
    }
}
 
}
