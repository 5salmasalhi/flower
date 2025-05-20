<x-app-layout>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('searchProducts', () => ({
                search: '{{ request('search') }}',
                async fetchProducts() {
                    const params = new URLSearchParams()
                    if (this.search) params.append('search', this.search)
                    if (this.$root.dataset.category) params.append('category', this.$root.dataset.category)
                    
                    try {
                        const response = await fetch(`{{ route('products.search') }}?${params.toString()}`)
                        if (!response.ok) throw new Error('Network response was not ok')
                        const data = await response.json()
                        this.$refs.productsGrid.innerHTML = data.html
                    } catch (error) {
                        console.error('Error:', error)
                    }
                }
            }))
        })
    </script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Our Flowers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Category Filter -->
            <div class="mb-8">
                <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900  mb-4">Filter by Category</h3>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-full {{ !request('category') ? 'bg-pink-500 text-white' : 'bg-gray-200  text-gray-800  hover:bg-gray-300 ' }}">
                                All
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="px-4 py-2 rounded-full {{ request('category') == $category->slug ? 'bg-pink-500 text-white' : 'bg-gray-200  text-gray-800  hover:bg-gray-300 ' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Bar and Products Grid Container -->
            <div x-data="searchProducts" data-category="{{ request('category') }}">
                <div class="mb-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex">
                                <input 
                                    type="text" 
                                    x-model="search" 
                                    x-on:input.debounce.300ms="fetchProducts()"
                                    placeholder="Search for flowers..." 
                                    class="flex-1 rounded-md border-gray-300 focus:border-pink-500 focus:ring-pink-500"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div 
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6"
                    x-ref="productsGrid">
                @forelse ($products as $product)
                    <div class="bg-white  overflow-hidden shadow-sm rounded-lg transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                        <a href="{{ route('products.show', $product) }}" class="block">
                            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200 ">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                                @else
                                    <div class="w-full h-64 bg-gray-200  flex items-center justify-center">
                                        <span class="text-gray-500 ">No image</span>
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
                                <h3 class="text-lg font-semibold text-gray-900  hover:text-pink-600 ">{{ $product->name }}</h3>
                            </a>
                            <p class="mt-1 text-gray-600  text-sm line-clamp-2">{{ $product->description }}</p>
                            <div class="mt-2 flex justify-between items-center">
                                <span class="text-lg font-medium text-gray-900 ">${{ number_format($product->price, 2) }}</span>
                                @if ($product->stock > 0)
                                    <span class="text-sm text-green-600 ">In Stock</span>
                                @else
                                    <span class="text-sm text-red-600 ">Out of Stock</span>
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
                        <h3 class="mt-2 text-lg font-medium text-gray-900 ">No products found</h3>
                        <p class="mt-1 text-gray-500 ">Try adjusting your search or filter to find what you're looking for.</p>
                        <div class="mt-6">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-pink-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-600 active:bg-pink-700 focus:outline-none focus:border-pink-700 focus:ring focus:ring-pink-300 disabled:opacity-25 transition">
                                Clear filters
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>