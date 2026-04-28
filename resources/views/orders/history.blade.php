<x-app-layout>
    <div class="py-12 bg-gradient-premium min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-12">
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-[0.2em] border border-emerald-100 mb-4">
                    Order Ledger
                </div>
                <h1 class="text-4xl font-black text-slate-900 tracking-tightest">Order History</h1>
                <p class="text-slate-500 font-medium text-lg mt-1">Track and manage your premium acquisitions.</p>
            </div>

            @if($orders->count() > 0)
                <div class="space-y-10">
                    @foreach($orders as $index => $order)
                        <div class="premium-card overflow-hidden animate-fade-in-up" style="animation-delay: {{ $index * 150 }}ms">
                            <!-- Order Header -->
                            <div class="bg-slate-50/80 backdrop-blur-sm px-8 py-8 border-b border-slate-100 flex flex-wrap justify-between items-center gap-8">
                                <div class="flex flex-wrap items-center gap-x-12 gap-y-6">
                                    <div>
                                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Order Reference</div>
                                        <div class="text-sm font-black text-slate-900 font-mono bg-white px-3 py-1 rounded-lg border border-slate-200">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                    <div>
                                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Acquisition Date</div>
                                        <div class="text-sm font-bold text-slate-700">{{ $order->created_at->format('M d, Y') }}</div>
                                    </div>
                                    <div>
                                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Transaction Status</div>
                                        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase tracking-widest border border-emerald-100 shadow-sm shadow-emerald-100/50">
                                            <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></div>
                                            {{ $order->status }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <button onclick="window.print()" class="flex items-center gap-2 px-4 py-2.5 bg-white rounded-xl border border-slate-200 text-slate-500 hover:text-primary-600 hover:border-primary-200 hover:shadow-lg transition-all group" title="Download Receipt">
                                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                        </svg>
                                        <span class="text-xs font-bold uppercase tracking-widest">Receipt</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Order Items -->
                            <div class="p-10">
                                <div class="space-y-8">
                                    @foreach($order->items as $id => $details)
                                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-6 py-6 border-b border-slate-50 last:border-0 hover:bg-slate-50/50 transition-colors -mx-4 px-4 rounded-2xl">
                                            <div class="flex items-center gap-6">
                                                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-slate-300 border border-slate-100 shrink-0 shadow-sm">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                                </div>
                                                <div>
                                                    <div class="font-black text-slate-900 text-xl leading-tight">{{ $details['name'] }}</div>
                                                    <div class="flex items-center gap-3 mt-2">
                                                        <span class="text-[10px] font-black text-slate-400 bg-slate-100 px-2 py-0.5 rounded uppercase tracking-widest">{{ $details['quantity'] }} Units</span>
                                                        <span class="text-xs text-slate-500 font-bold tracking-tight">${{ number_format($details['price'], 2) }} / unit</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-3xl font-black text-slate-900 tracking-tightest sm:text-right">
                                                ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-12 pt-10 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-8">
                                    <div class="flex items-center gap-4 py-3 px-6 bg-emerald-50/50 rounded-2xl border border-emerald-100/50">
                                        <div class="p-1.5 bg-emerald-500 rounded-full">
                                            <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
                                        </div>
                                        <span class="text-[10px] font-black text-emerald-700 uppercase tracking-[0.2em]">Verified Secure Acquisition</span>
                                    </div>
                                    <div class="flex items-center gap-8">
                                        <div class="text-right">
                                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] block mb-1">Total Investment</span>
                                            @php 
                                                $orderTotal = collect($order->items)->sum(fn($i) => $i['price'] * $i['quantity']);
                                            @endphp
                                            <span class="text-4xl font-black text-primary-600 tracking-tightest">${{ number_format($orderTotal, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-32 text-center glass-card rounded-[3rem] animate-fade-in-up">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 border border-slate-100 shadow-inner">
                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 mb-3 tracking-tight">No orders yet</h3>
                    <p class="text-slate-500 font-medium mb-10 max-w-xs mx-auto text-lg leading-relaxed">Your order history ledger is currently empty. Start building your collection.</p>
                    <a href="{{ route('dashboard') }}" class="btn-primary px-12 py-5 shadow-2xl shadow-primary-500/30">Explore Marketplace</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>