<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-pink-600  ">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ route('products.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-pink-600 md:ml-2  ">Products</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 ">{{ $product->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Product Image -->
                        <div>
                            <div class="bg-gray-100  rounded-lg overflow-hidden">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-cover">
                                @else
                                    <div class="w-full h-96 bg-gray-200  flex items-center justify-center">
                                        <span class="text-gray-500 ">No image available</span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Additional Images (if you have them) -->
                            <div class="mt-4 grid grid-cols-4 gap-2">
                                @if(isset($product->additional_images) && count($product->additional_images) > 0)
                                    @foreach($product->additional_images as $image)
                                        <div class="bg-gray-100  rounded-lg overflow-hidden">
                                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $product->name }}" class="w-full h-24 object-cover cursor-pointer hover:opacity-75 transition-opacity">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <!-- Product Details -->
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 ">{{ $product->name }}</h1>
                            
                            @if($product->category)
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800  ">
                                        {{ $product->category->name }}
                                    </span>
                                </div>
                            @endif
                            
                            <div class="mt-4">
                                <span class="text-2xl font-bold text-gray-900 ">${{ number_format($product->price, 2) }}</span>
                            </div>
                            
                            <div class="mt-6 space-y-6">
                                <p class="text-gray-700 ">{{ $product->description }}</p>
                                
                                <div class="border-t border-b border-gray-200  py-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-500 ">Availability:</span>
                                        @if ($product->stock > 0)
                                            <span class="text-sm font-medium text-green-600 ">In Stock ({{ $product->stock }} available)</span>
                                        @else
                                            <span class="text-sm font-medium text-red-600 ">Out of Stock</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <div class="mt-4">
                                        <label for="quantity" class="block text-sm font-medium text-gray-700 ">Quantity</label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="number" name="quantity" id="quantity" min="1" max="{{ $product->stock }}" value="1" class="block w-full rounded-md border-gray-300    focus:border-pink-500 focus:ring-pink-500" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-6">
                                        <button type="submit" class="w-full flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Add to Cart
                                        </button>
                                    </div>
                                </form>
                                
                                <!-- Wishlist Button (if you have this feature) -->
                                <div class="mt-4">
                                    <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center justify-center px-6 py-3 border border-gray-300  rounded-md shadow-sm text-base font-medium text-gray-700  bg-white  hover:bg-gray-50  focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 {{ in_array($product->id, session('wishlist', [])) ? 'text-pink-500' : 'text-gray-400' }}" fill="{{ in_array($product->id, session('wishlist', [])) ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            {{ in_array($product->id, session('wishlist', [])) ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Details Tabs -->
                    <div class="mt-12">
                        <div class="border-b border-gray-200 ">
                            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                <button class="tab-button border-pink-500 text-pink-600  whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="details">
                                    Details
                                </button>
                                <button class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300    whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="care">
                                    Care Instructions
                                </button>
                                <button class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300    whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" data-tab="reviews">
                                    Reviews
                                </button>
                            </nav>
                        </div>
                        
                        <!-- Tab Content -->
                        <div class="py-6">
                            <div id="details-content" class="tab-content">
                                <h3 class="text-lg font-medium text-gray-900  mb-4">Product Details</h3>
                                <div class="prose prose-pink max-w-none ">
                                    <p>{{ $product->description }}</p>
                                    
                                    @if(isset($product->details) && is_array($product->details))
                                        <ul class="mt-4">
                                            @foreach($product->details as $detail)
                                                <li>{{ $detail }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            
                            <div id="care-content" class="tab-content hidden">
                                <h3 class="text-lg font-medium text-gray-900  mb-4">Care Instructions</h3>
                                <div class="prose prose-pink max-w-none ">
                                    <p>To keep your flowers fresh for longer:</p>
                                    <ul>
                                        <li>Change the water every 2-3 days</li>
                                        <li>Trim the stems at an angle every few days</li>
                                        <li>Keep away from direct sunlight and heat sources</li>
                                        <li>Remove any leaves that fall below the water line</li>
                                        <li>Add flower food to the water if provided</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div id="reviews-content" class="tab-content hidden">
                                <h3 class="text-lg font-medium text-gray-900  mb-4">Customer Reviews</h3>
                                
                                @if(isset($product->reviews) && count($product->reviews) > 0)
                                    <div class="space-y-6">
                                        @foreach($product->reviews as $review)
                                            <div class="bg-gray-50  p-4 rounded-lg">
                                                <div class="flex items-center mb-2">
                                                    <div class="flex items-center">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <svg class="h-5 w-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300 ' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        @endfor
                                                    </div>
                                                    <span class="ml-2 text-sm text-gray-500 ">{{ $review->created_at->format('M d, Y') }}</span>
                                                </div>
                                                <h4 class="font-medium text-gray-900 ">{{ $review->title }}</h4>
                                                <p class="mt-1 text-gray-600 ">{{ $review->comment }}</p>
                                                <p class="mt-2 text-sm text-gray-500 ">By {{ $review->user->name }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500 ">No reviews yet. Be the first to review this product!</p>
                                    
                                    @auth
                                        <div class="mt-6">
                                            <a href="{{ route('products.review', $product) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                                Write a Review
                                            </a>
                                        </div>
                                    @else
                                        <div class="mt-6">
                                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                                Login to Write a Review
                                            </a>
                                        </div>
                                    @endauth
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Related Products -->
                    @if(isset($relatedProducts) && count($relatedProducts) > 0)
                        <div class="mt-12">
                            <h2 class="text-2xl font-bold text-gray-900  mb-6">You May Also Like</h2>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                                @foreach($relatedProducts as $relatedProduct)
                                    <div class="bg-white  overflow-hidden shadow-sm rounded-lg transition-transform duration-300 hover:shadow-lg hover:-translate-y-1">
                                        <a href="{{ route('products.show', $relatedProduct) }}" class="block">
                                            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden bg-gray-200 ">
                                                @if ($relatedProduct->image)
                                                    <img src="{{ asset('storage/' . $relatedProduct->image) }}" alt="{{ $relatedProduct->name }}" class="w-full h-48 object-cover">
                                                @else
                                                    <div class="w-full h-48 bg-gray-200  flex items-center justify-center">
                                                        <span class="text-gray-500 ">No image</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </a>
                                        <div class="p-4">
                                            <a href="{{ route('products.show', $relatedProduct) }}" class="block">
                                                <h3 class="text-lg font-semibold text-gray-900  hover:text-pink-600 ">{{ $relatedProduct->name }}</h3>
                                            </a>
                                            <div class="mt-2 flex justify-between items-center">
                                                <span class="text-lg font-medium text-gray-900 ">${{ number_format($relatedProduct->price, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab functionality
            const tabButtons = document.querySelectorAll('.tab-button');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons and contents
                    tabButtons.forEach(btn => {
                        btn.classList.remove('border-pink-500', 'text-pink-600', '');
                        btn.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300', '', '', '');
                    });
                    
                    tabContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    
                    // Add active class to clicked button
                    button.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300', '', '', '');
                    button.classList.add('border-pink-500', 'text-pink-600', '');
                    
                    // Show the corresponding content
                    const tabId = button.getAttribute('data-tab');
                    document.getElementById(`${tabId}-content`).classList.remove('hidden');
                });
            });
        });
    </script>
</x-app-layout>