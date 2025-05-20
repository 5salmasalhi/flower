@forelse ($products as $product)
    <div class="bg-white overflow-hidden shadow-sm rounded-lg transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
        <a href="{{ route('products.show', $product) }}" class="block">
            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200">
                @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">No image</span>
                    </div>
                @endif
                @if ($product->is_featured)
                    <div class="absolute top-2 right-2">
                        <span class="px-2 py-1 bg-yellow-500 text-white text-xs font-bold rounded-full">Featured</span>
                    </div>
                @endif
            </div>
        </a>
        <div class="p-4">
            <a href="{{ route('products.show', $product) }}" class="block">
                <h3 class="text-lg font-semibold text-gray-900 hover:text-pink-600">{{ $product->name }}</h3>
            </a>
            <p class="mt-1 text-gray-600 text-sm line-clamp-2">{{ $product->description }}</p>
            <div class="mt-2 flex justify-between items-center">
                <span class="text-lg font-medium text-gray-900">${{ number_format($product->price, 2) }}</span>
                @if ($product->stock > 0)
                    <span class="text-sm text-green-600">In Stock</span>
                @else
                    <span class="text-sm text-red-600">Out of Stock</span>
                @endif
            </div>
            <div class="mt-4">
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded-md transition-colors duration-300 {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full py-12 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h3 class="mt-2 text-lg font-medium text-gray-900">No products found</h3>
        <p class="mt-1 text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
        <div class="mt-6">
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-pink-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-600 active:bg-pink-700 focus:outline-none focus:border-pink-700 focus:ring focus:ring-pink-300 disabled:opacity-25 transition">
                Clear filters
            </a>
        </div>
    </div>
@endforelse
