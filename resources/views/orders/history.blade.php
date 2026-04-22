<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Order History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if($orders->count() > 0)
                    <div class="space-y-6">
                        @foreach($orders as $order)
                            <div class="border border-gray-200 rounded-lg p-4 shadow-sm">
                                <div class="flex justify-between items-center border-b pb-2 mb-4">
                                    <div>
                                        <span class="text-sm text-gray-500 uppercase font-bold">Order ID:</span>
                                        <span class="font-mono ml-1">#{{ $order->id }}</span>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $order->created_at->format('M d, Y - h:i A') }}
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    @foreach($order->items as $id => $details)
                                        <div class="flex justify-between items-center text-sm py-1 border-b border-gray-50 last:border-0">
                                <span class="text-gray-700">
                                    {{ $details['name'] }} 
                                <span class="ml-2 text-xs font-bold text-gray-400">x{{ $details['quantity'] }}</span>
                                </span>
                                <span class="font-mono text-gray-900">${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                                </div>
                                    @endforeach
                                </div>

                                <div class="mt-4 pt-4 border-t flex justify-between items-center">
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full font-bold uppercase">
                                        {{ $order->status }}
                                    </span>
                                    <div class="text-lg">
                                        <span class="text-gray-500 text-sm mr-1">Total Paid:</span>
                                        <span class="font-bold text-blue-600">${{ number_format($order->total_amount, 2) }}</span><a href="{{ route('orders.download', $order->id) }}" class="text-blue-600 hover:underline text-sm font-bold">
                                         Download Receipt (PDF)
                                    </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10">
                        <p class="text-gray-500 mb-4 text-lg">You haven't placed any orders yet.</p>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            Start Shopping
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>