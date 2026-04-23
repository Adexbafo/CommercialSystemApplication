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



       <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($products as $product)
        <div class="bg-white shadow-sm sm:rounded-lg p-6 border border-gray-200 flex flex-col justify-between">
            <div>
                <h3 class="font-bold text-lg text-gray-900">{{ $product->name }}</h3>
                <p class="text-gray-600 text-sm mt-2">{{ $product->description }}</p>
                <p class="mt-4 font-semibold text-blue-600 text-xl">${{ number_format($product->price, 2) }}</p>
            </div>

            <div class="mt-6">
                <p class="text-xs mb-2 {{ $product->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                    ● {{ $product->quantity > 0 ? $product->quantity . ' in stock' : 'Out of Stock' }}
                </p>

                @if($product->quantity > 0)
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <x-primary-button class="w-full justify-center">
                            Add to Cart
                        </x-primary-button>
                    </form>
                @else
                    <button disabled class="w-full bg-gray-200 text-gray-500 py-2 rounded-md cursor-not-allowed">
                        Sold Out
                    </button>
                @endif
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
