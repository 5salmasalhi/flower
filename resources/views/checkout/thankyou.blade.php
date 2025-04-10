<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    
                    <h1 class="mt-4 text-3xl font-bold text-gray-900 dark:text-gray-100">Thank You for Your Order!</h1>
                    
                    <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">
                        Your order #{{ $order->order_number }} has been placed successfully.
                    </p>
                    
                    <div class="mt-8 max-w-md mx-auto">
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg text-left">
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Order Summary</h2>
                            
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Order Number:</span>
                                    <span class="text-gray-900 dark:text-gray-100 font-medium">{{ $order->order_number }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Date:</span>
                                    <span class="text-gray-900 dark:text-gray-100">{{ $order->created_at->format('F j, Y') }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Total:</span>
                                    <span class="text-gray-900 dark:text-gray-100 font-medium">${{ number_format($order->total, 2) }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-gray-600 dark:text-gray-400">Payment Method:</span>
                                    <span class="text-gray-900 dark:text-gray-100">{{ ucfirst($order->payment_method) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <p class="text-gray-600 dark:text-gray-400">
                            We've sent a confirmation email to <span class="font-medium">{{ $order->email }}</span>.
                        </p>
                        <p class="mt-2 text-gray-600 dark:text-gray-400">
                            If you have any questions about your order, please contact our customer service.
                        </p>
                    </div>
                    
                    <div class="mt-8">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-700 active:bg-pink-800 focus:outline-none focus:border-pink-800 focus:ring focus:ring-pink-200 disabled:opacity-25 transition">
                            Continue Shopping
                        </a>
                        
                        @auth
                            <a href="{{ route('orders.show', $order) }}" class="ml-4 inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-700 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:border-gray-400 focus:ring focus:ring-gray-200 disabled:opacity-25 transition">
                                View Order Details
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>