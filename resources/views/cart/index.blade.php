<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if(session('cart'))
                    <div class="space-y-4">
                        @foreach(session('cart') as $id => $details)
                            <div class="flex flex-col sm:flex-row justify-between items-center border-b pb-4">
                                <div class="flex items-center">
                                    <img src="{{ $details['image'] }}" width="50" height="50" class="rounded">
                                    <div class="ml-4">
                                        <h4 class="font-bold">{{ $details['name'] }}</h4>
                                        <p class="text-sm text-gray-600">${{ $details['price'] }} x {{ $details['quantity'] }}</p>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0">
                                    <span class="font-bold text-lg">${{ $details['price'] * $details['quantity'] }}</span>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="text-right mt-6">
                            <h3 class="text-xl font-bold">Total: ${{ array_sum(array_column(session('cart'), 'price')) }}</h3>
                            <x-primary-button class="mt-4 w-full sm:w-auto">
                                Proceed to Checkout
                            </x-primary-button>
                        </div>
                    </div>
                @else
                    <p class="text-center text-gray-500">Your cart is empty.</p>
                    <div class="text-center mt-4">
                        <a href="{{ route('dashboard') }}" class="text-blue-500 underline">Go back to shopping</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>