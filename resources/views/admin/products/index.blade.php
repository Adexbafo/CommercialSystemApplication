<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin: Product Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-6">
                    <h3 class="text-lg font-bold">Product Inventory</h3>
                    <button class="bg-green-600 text-white px-4 py-2 rounded">Add New Product</button>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b bg-gray-50">
                            <th class="p-3">Name</th>
                            <th class="p-3">Price</th>
                            <th class="p-3">Stock Quantity</th>
                            <th class="p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 font-medium">{{ $product->name }}</td>
                            <td class="p-3">${{ number_format($product->price, 2) }}</td>
                            <td class="p-3">
                                <span class="{{ $product->quantity < 5 ? 'text-red-600 font-bold' : '' }}">
                                    {{ $product->quantity }}
                                </span>
                            </td>
                            <td class="p-3">
                                <button class="text-blue-600 hover:underline">Edit</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>