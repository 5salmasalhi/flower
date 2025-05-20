<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-900  mb-6">Your Shopping Cart</h1>
                    
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    
                    @if (session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif
                    
                    @if (count($products) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 ">
                                <thead class="bg-gray-50 ">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                            Product
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                            Price
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                            Quantity
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                            Subtotal
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white  divide-y divide-gray-200 ">
                                    @foreach ($products as $item)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-16 w-16">
                                                        @if ($item['product']->image)
                                                            <img class="h-16 w-16 object-cover rounded" src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}">
                                                        @else
                                                            <div class="h-16 w-16 bg-gray-200  rounded flex items-center justify-center">
                                                                <span class="text-gray-500  text-xs">No image</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="ml-4">
                                                        <a href="{{ route('products.show', $item['product']) }}" class="text-sm font-medium text-gray-900  hover:text-pink-600 ">
                                                            {{ $item['product']->name }}
                                                        </a>
                                                        @if ($item['product']->category)
                                                            <div class="text-xs text-gray-500  mt-1">
                                                                {{ $item['product']->category->name }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 ">${{ number_format($item['product']->price, 2) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form action="{{ route('cart.update', $item['product']) }}" method="POST" class="flex items-center">
                                                    @csrf
                                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="{{ $item['product']->stock }}" class="w-16 rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50">
                                                    <button type="submit" class="ml-2 text-sm text-pink-600  hover:text-pink-800 ">
                                                        Update
                                                    </button>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900 ">${{ number_format($item['subtotal'], 2) }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <form action="{{ route('cart.remove', $item['product']) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="text-red-600  hover:text-red-800 ">
                                                        Remove
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-8 flex flex-col md:flex-row justify-between items-start">
                            <div class="w-full md:w-1/2 lg:w-1/3 bg-gray-50  p-6 rounded-lg">
                                <h2 class="text-lg font-medium text-gray-900  mb-4">Order Summary</h2>
                                
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600 ">Subtotal</span>
                                    <span class="text-gray-900 ">${{ number_format($total, 2) }}</span>
                                </div>
                                
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600 ">Shipping</span>
                                    <span class="text-gray-900 ">Calculated at checkout</span>
                                </div>
                                
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600 ">Tax</span>
                                    <span class="text-gray-900 ">Calculated at checkout</span>
                                </div>
                                
                                <div class="border-t border-gray-200  my-4"></div>
                                
                                <div class="flex justify-between mb-4">
                                    <span class="text-lg font-medium text-gray-900 ">Estimated Total</span>
                                    <span class="text-lg font-medium text-gray-900 ">${{ number_format($total, 2) }}</span>
                                </div>
                                
                                <a href="{{ route('checkout.index') }}" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-4 rounded-md transition-colors duration-300 flex items-center justify-center">
                                    Proceed to Checkout
                                </a>
                            </div>
                            
                            <div class="w-full md:w-1/2 mt-6 md:mt-0 md:pl-8">
                                <div class="flex flex-col space-y-4">
                                    <a href="{{ route('products.index') }}" class="text-pink-600  hover:text-pink-800  flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                        </svg>
                                        Continue Shopping
                                    </a>
                                    
                                    <form action="{{ route('cart.clear') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-gray-600  hover:text-gray-800  flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Clear Cart
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="mt-8">
                                    <h3 class="text-lg font-medium text-gray-900  mb-4">Have a coupon?</h3>
                                    <form action="{{ route('cart.index') }}" method="GET" class="flex">
                                        <input type="text" name="coupon" placeholder="Enter coupon code" class="flex-1 rounded-l-md border-gray-300    focus:border-pink-500 focus:ring-pink-500">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-200  border border-transparent rounded-r-md font-semibold text-xs text-gray-700  uppercase tracking-widest hover:bg-gray-300  active:bg-gray-400  focus:outline-none focus:border-gray-400 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                            Apply
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h2 class="mt-2 text-lg font-medium text-gray-900 ">Your cart is empty</h2>
                            <p class="mt-1 text-gray-500 ">Looks like you haven't added any products to your cart yet.</p>
                            <div class="mt-6">
                                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-700 active:bg-pink-800 focus:outline-none focus:border-pink-800 focus:ring focus:ring-pink-200 disabled:opacity-25 transition">
                                    Browse Products
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>