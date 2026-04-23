<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #333; line-height: 1.5; }
        .invoice-header { border-bottom: 2px solid #4a90e2; padding-bottom: 20px; margin-bottom: 20px; }
        .invoice-title { font-size: 28px; color: #4a90e2; font-weight: bold; }
        .info-table { width: 100%; margin-bottom: 30px; }
        .items-table { width: 100%; border-collapse: collapse; }
        .items-table th { background: #f4f7f6; padding: 12px; border: 1px solid #ddd; text-align: left; }
        .items-table td { padding: 12px; border: 1px solid #ddd; }
        .total-section { text-align: right; margin-top: 30px; font-size: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="invoice-header">
        <table class="info-table">
            <tr>
                <td><span class="invoice-title">INVOICE</span></td>
                <td style="text-align: right;">
                    <strong>Order ID:</strong> #{{ $order->id }}<br>
                    <strong>Date:</strong> {{ $order->created_at->format('d M Y') }}
                </td>
            </tr>
        </table>
    </div>

    <table class="info-table">
        <tr>
            <td>
                <strong>Customer Info:</strong><br>
                {{ Auth::user()->name }}<br>
                {{ Auth::user()->email }}
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th>Item Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>${{ number_format($item['price'], 2) }}</td>
                <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        Total Amount Paid: ${{ number_format($order->total_amount, 2) }}
    </div>
</body>
</html>