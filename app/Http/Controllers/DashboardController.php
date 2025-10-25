<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Inventory;
use App\Models\Provider;
use App\Models\Patient;

class DashboardController extends Controller
{
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
    public function storeOrder(Request $request, \App\Services\OrderService $orderService)
    {
       //$this->authorize('create', Order::class);
        $validated = $request->validate([
            'provider_id' => 'required|exists:providers,id',
            'patient_id' => 'required|exists:patients,id',
            'inventory_id' => 'required|exists:inventories,id',
            'quantity' => 'required|integer|min:1',
        ]);

         $order = $orderService->createOrder($validated);
        return redirect()->back()->with('success', 'Order placed successfully!');
    }

}
