<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Product Details') }}
            </h2>
            <div>
                <a href="{{ route('admin.products.edit', $product) }}" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded mr-2">
                    Edit Product
                </a>
                <a href="{{ route('admin.products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <div class="aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-gray-500">No image available</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                            
                            <div class="mt-4 flex items-center">
                                <span class="text-gray-900 text-xl font-medium">${{ number_format($product->price, 2) }}</span>
                                
                                <div class="ml-4">
                                    @if ($product->is_active)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Inactive
                                        </span>
                                    @endif
                                    
                                    @if ($product->is_featured)
                                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Featured
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <h2 class="text-sm font-medium text-gray-900">Stock</h2>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $product->stock }} units
                                    @if ($product->stock < 5)
                                        <span class="text-red-500 ml-2">Low stock!</span>
                                    @endif
                                </p>
                            </div>
                            
                            <div class="mt-4">
                                <h2 class="text-sm font-medium text-gray-900">Description</h2>
                                <div class="mt-1 text-sm text-gray-500 space-y-2">
                                    {!! nl2br(e($product->description)) !!}
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <h2 class="text-sm font-medium text-gray-900">Product URL</h2>
                                <p class="mt-1 text-sm text-gray-500">
                                    <a href="{{ route('products.show', $product) }}" target="_blank" class="text-pink-600 hover:text-pink-900">
                                        {{ route('products.show', $product) }}
                                    </a>
                                </p>
                            </div>
                            
                            <div class="mt-6 flex items-center">
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete Product
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>