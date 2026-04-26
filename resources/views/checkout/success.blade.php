<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4">
            
            <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100">
                
                <div class="bg-emerald-500 p-8 text-center">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 backdrop-blur-md">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-white tracking-tight">Order Confirmed!</h1>
                    <p class="text-emerald-100 mt-2 font-medium">Thank you for your purchase, {{ auth()->user()->name }}.</p>
                </div>

                <div class="p-8 md:p-12">
                    <div class="flex flex-col md:flex-row md:justify-between gap-6 pb-8 border-b border-slate-100">
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Order Number</span>
                            <p class="text-xl font-bold text-slate-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Date</span>
                            <p class="text-lg font-semibold text-slate-900">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                        <div class="text-md-right">
                            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Amount</span>
                            <p class="text-2xl font-black text-primary-600">${{ number_format($order->total_price, 2) }}</p>
                        </div>
                    </div>

                    <div class="mt-10 flex flex-col sm:flex-row gap-4">
                        <button onclick="window.print()" class="flex-1 bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-slate-800 transition-all flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                     Print Receipt (PDF)
                      </button>
                        
                        <a href="{{ route('dashboard') }}" class="flex-1 bg-white text-slate-600 px-8 py-4 rounded-2xl font-bold border border-slate-200 hover:bg-slate-50 transition-all text-center">
                            Return to Marketplace
                        </a>
                    </div>
                </div>
            </div>

            <p class="text-center mt-8 text-slate-400 text-sm">
                A copy of this receipt has been saved to your account profile.
            </p>
        </div>
    </div>
</x-app-layout>