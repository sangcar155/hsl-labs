@component('mail::message')
# Order Confirmation

Hello {{ $order->provider->name }},

Your order has been successfully placed.

**Order Details:**
- Product: {{ $order->inventory->product_name ?? 'Product' }}
- Quantity: {{ $order->quantity }}
- Total: ${{ $order->total }}

Thank you for your business!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
