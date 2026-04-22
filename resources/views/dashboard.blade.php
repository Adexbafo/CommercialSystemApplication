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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-200">
                    <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                    <p class="text-gray-600">{{ $product->description }}</p>
                    <p class="mt-4 font-semibold text-blue-600">${{ $product->price }}</p>
                    
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                        @csrf
                        <x-primary-button>Add to Cart</x-primary-button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</x-app-layout>
