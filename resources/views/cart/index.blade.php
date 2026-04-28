<x-app-layout>
    <div class="py-12 bg-gradient-premium min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex items-center gap-6 mb-12">
                <a href="{{ route('dashboard') }}" class="p-3 bg-white rounded-2xl shadow-sm border border-slate-100 text-slate-500 hover:text-primary-600 hover:shadow-md transition-all group">
                    <svg class="w-6 h-6 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </a>
                <div>
                    <h1 class="text-4xl font-black text-slate-900 tracking-tightest">My Bag</h1>
                    <p class="text-slate-500 font-medium mt-1">Review and manage your selected items.</p>
                </div>
            </div>

            @if(session('cart') && count(session('cart')) > 0)
                <div class="grid lg:grid-cols-12 gap-10 items-start">
                    <!-- Cart Items -->
                    <div class="lg:col-span-7 space-y-6">
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity']; @endphp
                            <div class="premium-card p-6 flex flex-col sm:flex-row items-start sm:items-center gap-6 animate-in slide-in-from-left duration-500 relative group">
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="absolute top-4 right-4 sm:top-6 sm:right-6 opacity-0 group-hover:opacity-100 transition-opacity">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-rose-50 text-rose-500 rounded-xl hover:bg-rose-500 hover:text-white transition-all shadow-sm" title="Remove Item">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                                <div class="w-24 h-24 sm:w-28 sm:h-28 bg-slate-50 rounded-[1.5rem] overflow-hidden shrink-0 border border-slate-100">
                                    @if($details['image'])
                                        <img src="{{ asset('storage/' . $details['image']) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-200">
                                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <div class="flex justify-between items-start mb-2 pr-12">
                                        <h4 class="text-xl font-black text-slate-900 leading-tight">{{ $details['name'] }}</h4>
                                    </div>
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="flex items-center bg-slate-50 rounded-lg border border-slate-100 px-1">
                                            <form action="{{ route('cart.update', $id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="quantity" value="{{ $details['quantity'] - 1 }}">
                                                <button type="submit" class="p-1 text-slate-400 hover:text-primary-600 disabled:opacity-30" {{ $details['quantity'] <= 1 ? 'disabled' : '' }}>
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 12H4"/></svg>
                                                </button>
                                            </form>
                                            <span class="px-3 text-sm font-black text-slate-700 min-w-[2rem] text-center">{{ $details['quantity'] }}</span>
                                            <form action="{{ route('cart.update', $id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="quantity" value="{{ $details['quantity'] + 1 }}">
                                                <button type="submit" class="p-1 text-slate-400 hover:text-primary-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                        <span class="text-sm font-bold text-slate-500">@ ${{ number_format($details['price'], 2) }}</span>
                                    </div>
                                    <div class="text-2xl font-black text-primary-600 tracking-tight">
                                        ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Summary Card -->
                    <div class="lg:col-span-5">
                        <div class="premium-card p-10 sticky top-28 bg-slate-900 text-white overflow-hidden group">
                            <!-- Background Accent -->
                            <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary-600/20 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-1000"></div>
                            
                            <h3 class="text-2xl font-black mb-10 relative z-10">Checkout Details</h3>
                            
                            <div class="space-y-6 mb-10 relative z-10">
                                <div class="flex justify-between text-slate-400 font-medium">
                                    <span>Subtotal</span>
                                    <span class="font-bold text-white">${{ number_format($total, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-slate-400 font-medium">
                                    <span>Shipping</span>
                                    <span class="font-black text-emerald-400 uppercase text-xs tracking-widest">Complimentary</span>
                                </div>
                                <div class="h-px bg-white/10 my-8"></div>
                                <div class="flex justify-between items-center">
                                    <div>
                                        <span class="text-sm font-black text-slate-400 uppercase tracking-widest block mb-1">Total Amount</span>
                                        <span class="text-4xl font-black text-white tracking-tightest">${{ number_format($total, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('cart.checkout') }}" method="POST" class="relative z-10">
                                @csrf
                                <button type="submit" class="w-full bg-white text-slate-900 py-5 rounded-[1.5rem] font-black uppercase tracking-widest text-sm hover:bg-primary-50 transition-all shadow-2xl active:scale-95 group/btn">
                                    Authorize Payment
                                    <svg class="w-5 h-5 inline-block ml-2 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                </button>
                            </form>
                            
                            <div class="mt-8 pt-8 border-t border-white/5 flex items-center justify-center gap-3 relative z-10">
                                <svg class="w-5 h-5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 4.946-3.078 9.172-7.414 10.826a.5.5 0 01-.352 0c-4.336-1.654-7.414-5.88-7.414-10.826 0-.68.056-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-xs font-bold text-slate-400 tracking-wider">End-to-End Encrypted Transaction</span>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="py-32 text-center glass-card rounded-[3rem] animate-in zoom-in duration-700">
                    <div class="w-24 h-24 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-8 border border-slate-100">
                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    </div>
                    <h3 class="text-3xl font-black text-slate-900 mb-3">Your bag is empty</h3>
                    <p class="text-slate-500 font-medium mb-10 max-w-xs mx-auto">Looks like you haven't added any premium items to your collection yet.</p>
                    <a href="{{ route('dashboard') }}" class="btn-primary px-10 shadow-xl shadow-primary-500/20">Start Exploring</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>