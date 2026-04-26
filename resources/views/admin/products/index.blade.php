<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin: Product Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
    <h3 class="text-lg font-bold text-gray-800">Product Inventory</h3>
    
    <div class="flex items-center space-x-4">
        @if($lowStockCount > 0)
            <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded-full border border-red-400">
                {{ $lowStockCount }} Items Low in Stock
            </span>
        @endif

        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
            View Storefront
        </a>

           <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition ease-in-out duration-150">
            + Add New Product
            </a>
            </div>
                </div>

                 </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <th class="p-4">Category</th>
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
                            <td class="p-4">
                            {{ $product->category->name ?? 'Uncategorized' }}
                            </td>
                            <td class="p-3 font-medium">{{ $product->name }}</td>
                            <td class="p-3">${{ number_format($product->price, 2) }}</td>
                            <td class="p-3">
                                <span class="{{ $product->quantity < 5 ? 'text-red-600 font-bold' : '' }}">
                                    {{ $product->quantity }}
                                </span>
                            </td>
                           <td class="p-3">
    <div class="flex items-center space-x-4">
        <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-600 hover:text-blue-900 font-medium">
            Edit
        </a>

        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                Delete
            </button>
        </form>
    </div>
</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>