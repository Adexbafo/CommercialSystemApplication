<x-app-layout>
    <div class="py-12 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-slate-900 mb-8">Order Management</h1>

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-200">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Order ID</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Customer</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Total Price</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($orders as $order)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 font-bold text-slate-700">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $order->user->name }}</td>
                            <td class="px-6 py-4 font-bold text-emerald-600">${{ number_format($order->total_price, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 uppercase">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-500 text-sm">{{ $order->created_at->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-6 bg-slate-50">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>