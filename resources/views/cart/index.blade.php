<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex items-center gap-4 mb-10">
                <a href="{{ route('dashboard') }}" class="p-2 bg-white rounded-xl shadow-sm border border-slate-200 text-slate-500 hover:text-primary-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight">Shopping Cart</h1>
            </div>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Cart Items -->
                    <div class="lg:col-span-2 space-y-4">
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity']; @endphp
                            <div class="premium-card p-4 flex items-center gap-4">
                                <div class="w-20 h-20 bg-slate-100 rounded-xl overflow-hidden shrink-0">
                                    @if($details['image'])
                                        <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <h4 class="font-bold text-slate-900">{{ $details['name'] }}</h4>
                                    <p class="text-sm font-medium text-slate-500">${{ number_format($details['price'], 2) }} per unit</p>
                                </div>
                                <div class="text-right flex flex-col items-end gap-2">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Qty: {{ $details['quantity'] }}</span>
                                    <span class="text-lg font-bold text-slate-900">${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Summary Card -->
                    <div class="space-y-4">
                        <div class="premium-card p-6 sticky top-28">
                            <h3 class="text-xl font-bold text-slate-900 mb-6">Order Summary</h3>
                            
                            <div class="space-y-4 mb-8">
                                <div class="flex justify-between text-slate-600">
                                    <span>Subtotal</span>
                                    <span class="font-bold text-slate-900">${{ number_format($total, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-slate-600">
                                    <span>Shipping</span>
                                    <span class="font-bold text-emerald-600 uppercase text-xs">Free</span>
                                </div>
                                <div class="h-px bg-slate-100 my-4"></div>
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-slate-900">Total</span>
                                    <span class="text-3xl font-extrabold text-primary-600 tracking-tight">${{ number_format($total, 2) }}</span>
                                </div>
                            </div>

                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-primary w-full py-4 text-lg">
                                    Proceed to Checkout
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                </button>
                            </form>
                            
                            <p class="mt-6 text-xs text-slate-400 text-center flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                Secure checkout by CommercialSystem
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="py-24 text-center glass-card rounded-[2rem]">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6 text-slate-400">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-2">Your cart is empty</h3>
                    <p class="text-slate-500 mb-8">It looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('dashboard') }}" class="btn-primary">Start Shopping</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>