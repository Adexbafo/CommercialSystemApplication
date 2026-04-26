<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Page Header -->
            <div class="mb-10 flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div class="space-y-2">
                    <h1 class="text-4xl font-bold text-slate-900 tracking-tight">Marketplace</h1>
                    <p class="text-slate-500 font-medium">Discover premium products from our curated selection.</p>
                </div>
                
                <!-- Search Section -->
                <div class="w-full md:w-96">
                    <form action="{{ route('dashboard') }}" method="GET" class="relative group">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search products..." 
                            value="{{ request('search') }}"
                            class="w-full pl-12 pr-4 py-3 bg-white rounded-2xl border-slate-200 shadow-sm focus:border-primary-500 focus:ring-primary-500 transition-all"
                        >
                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        @if(request('search'))
                            <a href="{{ route('dashboard') }}" class="absolute right-3 top-1/2 -translate-y-1/2 p-1 text-slate-400 hover:text-slate-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            @if($products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($products as $product)
                        <div class="premium-card group flex flex-col overflow-hidden">
                            <!-- Product Image Container -->
                            <div class="aspect-[4/3] relative overflow-hidden bg-slate-100">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400">
                                        <svg class="w-12 h-12 mb-2 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <span class="text-xs font-bold uppercase tracking-wider">No Image</span>
                                    </div>
                                @endif
                                
                                <!-- Category Badge (Static for now) -->
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1 rounded-full bg-white/90 backdrop-blur-sm text-[10px] font-bold text-slate-800 uppercase tracking-widest border border-white/20">
                                        Premium
                                    </span>
                                </div>

                                <!-- Quick Stock Indicator -->
                                @if($product->quantity > 0 && $product->quantity < 5)
                                    <div class="absolute bottom-4 right-4">
                                        <span class="px-2 py-1 rounded-md bg-amber-500 text-[10px] font-bold text-white uppercase tracking-wider shadow-lg">
                                            Low Stock
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Info -->
                            <div class="p-6 flex-grow flex flex-col">
                                <div class="mb-4">
                                    <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-primary-600 transition-colors">
                                        {{ $product->name }}
                                    </h3>
                                    <p class="text-slate-500 text-sm line-clamp-2 leading-relaxed">
                                        {{ $product->description }}
                                    </p>
                                </div>
                                
                                <div class="mt-auto pt-6 border-t border-slate-50">
                                    <div class="flex justify-between items-center mb-6">
                                        <div class="flex flex-col">
                                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Price</span>
                                            <span class="text-2xl font-bold text-slate-900">${{ number_format($product->price, 2) }}</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Stock</span>
                                            <div class="flex items-center gap-1.5 justify-end">
                                                <div class="w-1.5 h-1.5 rounded-full {{ $product->quantity > 0 ? 'bg-emerald-500' : 'bg-rose-500' }}"></div>
                                                <span class="text-sm font-bold {{ $product->quantity > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                                    {{ $product->quantity > 0 ? $product->quantity . ' units' : 'Sold Out' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    @if($product->quantity > 0)
                                        <div class="space-y-3">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                               <button type="submit" class="btn-secondary w-full py-2">
                               Add to Cart
                                </button>
                                 </form>

                                  <form action="{{ route('checkout.store', $product->id) }}" method="POST">
                                   @csrf
                                   <button type="submit" class="btn-primary w-full group/btn py-3">
                                    Buy Now & Get Receipt
                                    <svg class="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                    </svg>
                                    </button>
                                    </form>
                                    </div>
                                    @else
                                        <button disabled class="w-full bg-slate-100 text-slate-400 py-3 rounded-xl cursor-not-allowed font-bold flex items-center justify-center">
                                            Out of Stock
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-24 text-center glass-card rounded-[2rem]">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 mb-2">No products found</h3>
                    <p class="text-slate-500 mb-8">Try adjusting your search filters or browse our full collection.</p>
                    <a href="{{ route('dashboard') }}" class="btn-secondary">Clear Search</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
