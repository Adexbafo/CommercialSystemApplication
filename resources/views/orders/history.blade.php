<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-10">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Order History</h1>
                <p class="text-slate-500 font-medium mt-2">Track and manage your past transactions.</p>
            </div>

            @if($orders->count() > 0)
                <div class="space-y-6">
                    @foreach($orders as $order)
                        <div class="premium-card overflow-hidden">
                            <!-- Order Header -->
                            <div class="bg-slate-50/50 px-6 py-4 border-b border-slate-100 flex flex-wrap justify-between items-center gap-4">
                                <div class="flex items-center gap-6">
                                    <div>
                                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Order ID</div>
                                        <div class="text-sm font-bold text-slate-900 font-mono">#{{ $order->id }}</div>
                                    </div>
                                    <div>
                                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Placed On</div>
                                        <div class="text-sm font-bold text-slate-700">{{ $order->created_at->format('M d, Y') }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-[10px] font-bold uppercase tracking-wider border border-emerald-200">
                                        {{ $order->status }}
                                    </span>
                                    <a href="{{ route('orders.download', $order->id) }}" class="p-2 bg-white rounded-lg border border-slate-200 text-slate-500 hover:text-primary-600 hover:border-primary-200 transition-all shadow-sm group" title="Download Receipt">
                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Order Items -->
                            <div class="p-6">
                                <div class="space-y-4">
                                    @foreach($order->items as $id => $details)
                                        <div class="flex justify-between items-center py-2 border-b border-slate-50 last:border-0">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center text-slate-400">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                                </div>
                                                <div>
                                                    <div class="font-bold text-slate-800">{{ $details['name'] }}</div>
                                                    <div class="text-xs text-slate-500 font-medium">Quantity: {{ $details['quantity'] }} &bull; ${{ number_format($details['price'], 2) }} each</div>
                                                </div>
                                            </div>
                                            <div class="font-bold text-slate-900">${{ number_format($details['price'] * $details['quantity'], 2) }}</div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-6 pt-6 border-t border-slate-100 flex justify-end items-center gap-4">
                                    <span class="text-sm font-bold text-slate-400 uppercase tracking-widest">Order Total:</span>
                                    @php 
                                        $orderTotal = collect($order->items)->sum(fn($i) => $i['price'] * $i['quantity']);
                                    @endphp
                                    <span class="text-2xl font-extrabold text-slate-900 tracking-tight">${{ number_format($orderTotal, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-24 text-center glass-card rounded-[2rem]">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-2">No orders found</h3>
                    <p class="text-slate-500 mb-8">You haven't placed any orders yet. Start your first transaction today!</p>
                    <a href="{{ route('dashboard') }}" class="btn-primary">Go to Marketplace</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>