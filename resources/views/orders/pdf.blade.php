<style>
    body { font-family: sans-serif; }
    .header { border-bottom: 2px solid #2563eb; padding-bottom: 10px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { text-align: left; padding: 10px; border-bottom: 1px solid #eee; }
</style>

<div class="header">
    <h1>CommercialSystemApplication</h1>
    <p>Order Receipt #{{ $order->id }}</p>
</div>

<p>Date: {{ $order->created_at->format('M d, Y') }}</p>

<table>
    <thead>
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['quantity'] }}</td>
            <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>Total Paid: ${{ number_format($order->total_amount, 2) }}</h3>