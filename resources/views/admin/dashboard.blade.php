<x-app-layout>
    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-12">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight">Admin Control Center</h1>
                <p class="text-slate-500 mt-2">Welcome back, Adexmakai. Here is what's happening today.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm">
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Total Revenue</p>
                    <p class="text-3xl font-black text-emerald-600 mt-2">${{ number_format(\App\Models\Order::sum('total_price'), 2) }}</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm">
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Total Sales</p>
                    <p class="text-3xl font-black text-blue-600 mt-2">{{ \App\Models\Order::count() }} Orders</p>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-200 shadow-sm">
                    <p class="text-sm font-bold text-slate-500 uppercase tracking-wider">Low Stock Alert</p>
                    <p class="text-3xl font-black text-orange-600 mt-2">{{ \App\Models\Product::where('quantity', '<', 5)->count() }} Items</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <a href="{{ route('admin.products') }}" class="group bg-white p-8 rounded-[2rem] shadow-sm border border-slate-200 hover:shadow-xl hover:border-blue-500 transition-all">
                    <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Inventory Management</h2>
                    <p class="text-slate-500 mt-2">Manage your {{ \App\Models\Product::count() }} products and stock levels.</p>
                </a>

                <a href="{{ route('admin.orders') }}" class="group bg-white p-8 rounded-[2rem] shadow-sm border border-slate-200 hover:shadow-xl hover:border-emerald-500 transition-all">
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900">Customer Orders</h2>
                    <p class="text-slate-500 mt-2">Review sales and fulfill the latest customer requests.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>