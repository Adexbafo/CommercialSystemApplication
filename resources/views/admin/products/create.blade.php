<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <h2 class="text-2xl font-bold mb-4">Add New Product</h2>
                
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="name" value="Product Name" />
                        <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" required />
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-input-label for="price" value="Price ($)" />
                            <x-text-input id="price" name="price" type="number" step="0.01" class="block mt-1 w-full" required />
                        </div>
                        <div>
                            <x-input-label for="quantity" value="Initial Stock" />
                            <x-text-input id="quantity" name="quantity" type="number" class="block mt-1 w-full" required />
                        </div>
                    </div>

                    <div class="mb-4">
                 <x-input-label for="category_id" value="Category" />
                <select name="category_id" id="category_id" class="...">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
                </select>
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" value="Description" />
                        <textarea name="description" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500"></textarea>
                    </div>

                    <div class="mb-6">
                        <x-input-label for="image" value="Product Image" />
                        <input type="file" name="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                    </div>

                    <x-primary-button>Save Product</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>