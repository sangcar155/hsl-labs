<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Inventory;
use App\Models\Provider;
use App\Models\Patient;
use App\Exceptions\InsufficientStockException;
use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
class DashboardController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = Order::with(['provider', 'patient', 'inventory'])->get();
      //  dd($orders);
        $inventories = Inventory::all();
        $providers = Provider::all();
        $patients = Patient::all();
        return view('dashboard.index', compact('orders', 'inventories', 'providers', 'patients'));
    }
     public function orders()
    {
        $orders = Order::with(['provider', 'patient', 'inventory'])->get();
      //  dd($orders);
        $inventories = Inventory::all();
        $providers = Provider::all();
        $patients = Patient::all();
        return view('dashboard.orders', compact('orders', 'inventories', 'providers', 'patients'));
    }
    public function store(OrderRequest $request)
    {
    $payload = $request->validated();

    try {
        $this->orderService->createOrder($payload);

        return redirect()
            ->back()
            ->with('success', 'Order placed successfully!');

    } catch (InsufficientStockException $e) {

        return redirect()
            ->back()
            ->withErrors(['quantity' => $e->getMessage()])
            ->withInput();

    } catch (\Exception $e) {

        return redirect()
            ->back()
            ->withErrors(['error' => 'Something went wrong. Please try again later.'])
            ->withInput();
    }
    }


}
