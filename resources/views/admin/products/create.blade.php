@extends($layout ?? 'layouts.admin')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 ">Produits</h1>
        </div>

        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 ">
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 ">Product Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300    focus:border-pink-500 focus:ring-pink-500"
                                        required>
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700 ">Price ($)</label>
                                    <input type="number" name="price" id="price" value="{{ old('price') }}" step="0.01"
                                        min="0"
                                        class="mt-1 block w-full rounded-md border-gray-300    focus:border-pink-500 focus:ring-pink-500"
                                        required>
                                    @error('price')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="stock" class="block text-sm font-medium text-gray-700 ">Stock</label>
                                    <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" min="0"
                                        class="mt-1 block w-full rounded-md border-gray-300    focus:border-pink-500 focus:ring-pink-500"
                                        required>
                                    @error('stock')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-700 ">Product
                                        Image</label>
                                    <input type="file" name="image" id="image"
                                        class="mt-1 block w-full text-sm text-gray-500  file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-50 file:text-pink-700   hover:file:bg-pink-100 ">
                                    @error('image')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="description"
                                        class="block text-sm font-medium text-gray-700 ">Description</label>
                                    <textarea name="description" id="description" rows="4"
                                        class="mt-1 block w-full rounded-md border-gray-300    focus:border-pink-500 focus:ring-pink-500">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="is_featured" name="is_featured" type="checkbox" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                                class="h-4 w-4 rounded border-gray-300  text-pink-600 focus:ring-pink-500 ">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="is_featured" class="font-medium text-gray-700 ">Featured
                                                Product</label>
                                            <p class="text-gray-500 ">Featured products appear on the home page.</p>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5">
                                            <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', 1) ? 'checked' : '' }}
                                                class="h-4 w-4 rounded border-gray-300  text-pink-600 focus:ring-pink-500 ">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="is_active" class="font-medium text-gray-700 ">Active</label>
                                            <p class="text-gray-500 ">Inactive products are not visible to customers.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <button type="submit"
                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                    Create Product
                                </button>
                                <a href="{{ route('admin.products.index') }}"
                                    class="ml-3 inline-flex justify-center py-2 px-4 border border-gray-300  shadow-sm text-sm font-medium rounded-md text-gray-700  bg-white  hover:bg-gray-50  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection