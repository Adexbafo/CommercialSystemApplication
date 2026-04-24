<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('dashboard') }}" method="GET" class="mb-6">
            <input type="text" name="search" placeholder="Search products..." class="border-gray-300 rounded-md shadow-sm">
            <x-primary-button type="submit">Search</x-primary-button>
        </form>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
        <form action="{{ route('dashboard') }}" method="GET" class="flex gap-2">
        <input 
            type="text" 
            name="search" 
            placeholder="Search products (e.g., Watch, Wallet...)" 
            value="{{ request('search') }}"
            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
        >
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md font-bold hover:bg-blue-700 transition">
            Search
        </button>
        @if(request('search'))
            <a href="{{ route('dashboard') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md flex items-center">
                Clear
            </a>
        @endif
      </form>
      </div>



       <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($products as $product)
        <div class="bg-white overflow-hidden shadow-md rounded-lg border border-gray-100 flex flex-col">
            
            <div class="h-48 w-full bg-gray-200">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400 italic bg-gray-50">
                        <span>No image available</span>
                    </div>
                @endif
            </div>

            <div class="p-5 flex-grow flex flex-col">
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $product->name }}</h3>
                <p class="text-gray-600 text-sm line-clamp-2 mb-4">
                    {{ $product->description }}
                </p>
                
                <div class="mt-auto">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-2xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
                        <span class="text-xs font-medium {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                            ● {{ $product->quantity > 0 ? $product->quantity . ' in stock' : 'Out of Stock' }}
                        </span>
                    </div>

                    @if($product->quantity > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <x-primary-button class="w-full justify-center py-3">
                                Add to Cart
                            </x-primary-button>
                        </form>
                    @else
                        <button disabled class="w-full bg-gray-200 text-gray-500 py-3 rounded-md cursor-not-allowed font-semibold">
                            Sold Out
                        </button>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
    </div>
</div>
            </div>
        </div>
    </div>
</x-app-layout>
