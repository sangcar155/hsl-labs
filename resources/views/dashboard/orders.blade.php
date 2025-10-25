@extends('dashboard')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('dashboard.order.store') }}" method="POST" class="mb-4">
    @csrf
    <div class="row mb-2">
        <div class="col">
            <label>Provider</label>
            <select name="provider_id" class="form-select" required>
                @foreach($providers as $provider)
                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label>Patient</label>
            <select name="patient_id" class="form-select" required>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label>Inventory</label>
            <select name="inventory_id" class="form-select" required>
                @foreach($inventories as $item)
                    <option value="{{ $item->id }}">{{ $item->product_name }} ({{ $item->quantity }} available)</option>
                @endforeach
            </select>
        </div>
        <div class="col">
            <label>Quantity</label>
            <input type="number" name="quantity" min="1" class="form-control" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Place Order</button>
</form>

    <h2>Orders</h2>
    <p>All your orders will appear here.</p>
    <div class="container mt-5">
    <h1>Dashboard</h1>

    <h3>Orders</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Provider</th>
                <th>Inventory</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->provider->name }}</td>
                <td>{{ $order->inventory->product_name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Inventories</h3>
    <ul>
        @foreach($inventories as $item)
            <li>{{ $item->product_name }} — Quantity: {{ $item->quantity }} — Price: {{ $item->price }}</li>
        @endforeach
    </ul>
</div>
@endsection
