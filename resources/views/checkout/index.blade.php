<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-900  mb-6">Checkout</h1>
                    
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
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Checkout Form -->
                        <div>
                            <h2 class="text-lg font-medium text-gray-900  mb-4">Shipping Information</h2>
                            
                            <form action="{{ route('checkout.process') }}" method="POST">
                                @csrf
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="first_name" class="block text-sm font-medium text-gray-700 ">First Name</label>
                                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name', auth()->user()->first_name ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" required>
                                        @error('first_name')
                                            <p class="mt-1 text-sm text-red-600 ">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div>
                                        <label for="last_name" class="block text-sm font-medium text-gray-700 ">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name', auth()->user()->last_name ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" required>
                                        @error('last_name')
                                            <p class="mt-1 text-sm text-red-600 ">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700 ">Email Address</label>
                                    <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" required>
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600 ">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="phone" class="block text-sm font-medium text-gray-700 ">Phone Number</label>
                                    <input type="tel" name="phone" id="phone" value="{{ old('phone', auth()->user()->phone ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" required>
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600 ">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="address" class="block text-sm font-medium text-gray-700 ">Address</label>
                                    <input type="text" name="address" id="address" value="{{ old('address', auth()->user()->address ?? '') }}" class="mt-1 block w-full rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50" required>
                                    @error('address')
                                        <p class="mt-1 text-sm text-red-600 ">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mb-4">
                                    <label for="notes" class="block text-sm font-medium text-gray-700 ">Order Notes (Optional)</label>
                                    <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50">{{ old('notes') }}</textarea>
                                </div>
                                
                                <h2 class="text-lg font-medium text-gray-900  mb-4 mt-8">Payment Information</h2>
                                
                                <div class="mb-4">
                                    <label for="payment_method" class="block text-sm font-medium text-gray-700 ">Payment Method</label>
                                    <div class="mt-2 space-y-2">
                                        <div class="flex items-center">
                                            <input id="payment_method_card" name="payment_method" type="radio" value="card" class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300" checked>
                                            <label for="payment_method_card" class="ml-3 block text-sm font-medium text-gray-700 ">
                                                Credit/Debit Card
                                            </label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="payment_method_paypal" name="payment_method" type="radio" value="paypal" class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300">
                                            <label for="payment_method_paypal" class="ml-3 block text-sm font-medium text-gray-700 ">
                                                PayPal
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="card_payment_fields" class="mb-4">
                                    <div class="mb-4">
                                        <label for="card_number" class="block text-sm font-medium text-gray-700 ">Card Number</label>
                                        <input type="text" name="card_number" id="card_number" placeholder="1234 5678 9012 3456" class="mt-1 block w-full rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50">
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label for="expiry_date" class="block text-sm font-medium text-gray-700 ">Expiry Date</label>
                                            <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YY" class="mt-1 block w-full rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50">
                                        </div>
                                        
                                        <div>
                                            <label for="cvv" class="block text-sm font-medium text-gray-700 ">CVV</label>
                                            <input type="text" name="cvv" id="cvv" placeholder="123" class="mt-1 block w-full rounded-md border-gray-300    shadow-sm focus:border-pink-500 focus:ring focus:ring-pink-500 focus:ring-opacity-50">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-8">
                                    <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white font-bold py-3 px-4 rounded-md transition-colors duration-300">
                                        Place Order
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Order Summary -->
                        <div>
                            <h2 class="text-lg font-medium text-gray-900  mb-4">Order Summary</h2>
                            
                            <div class="bg-gray-50  p-6 rounded-lg">
                                <div class="flow-root">
                                    <ul role="list" class="-my-6 divide-y divide-gray-200 ">
                                        @foreach ($products as $item)
                                            <li class="py-6 flex">
                                                <div class="flex-shrink-0 w-24 h-24 overflow-hidden rounded-md border border-gray-200 ">
                                                    @if ($item['product']->image)
                                                        <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full bg-gray-200  flex items-center justify-center">
                                                            <span class="text-gray-500  text-xs">No image</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                
                                                <div class="ml-4 flex-1 flex flex-col">
                                                    <div>
                                                        <div class="flex justify-between text-base font-medium text-gray-900 ">
                                                            <h3>{{ $item['product']->name }}</h3>
                                                            <p class="ml-4">${{ number_format($item['subtotal'], 2) }}</p>
                                                        </div>
                                                        <p class="mt-1 text-sm text-gray-500 ">
                                                            Qty: {{ $item['quantity'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <div class="border-t border-gray-200  pt-6 mt-6">
                                    <div class="flex justify-between text-base font-medium text-gray-900  mb-2">
                                        <p>Subtotal</p>
                                        <p>${{ number_format($subtotal, 2) }}</p>
                                    </div>
                                    
                                    <div class="flex justify-between text-base font-medium text-gray-900  mb-2">
                                        <p>Shipping</p>
                                        <p>${{ number_format($shipping, 2) }}</p>
                                    </div>
                                    
                                    <div class="flex justify-between text-base font-medium text-gray-900  mb-2">
                                        <p>Tax</p>
                                        <p>${{ number_format($tax, 2) }}</p>
                                    </div>
                                    
                                    <div class="flex justify-between text-lg font-bold text-gray-900  border-t border-gray-200  pt-4 mt-4">
                                        <p>Total</p>
                                        <p>${{ number_format($total, 2) }}</p>
                                    </div>
                                </div>
                                
                                <div class="mt-6">
                                    <a href="{{ route('cart.index') }}" class="text-pink-600  hover:text-pink-800  flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                        </svg>
                                        Return to Cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethodCard = document.getElementById('payment_method_card');
            const paymentMethodPaypal = document.getElementById('payment_method_paypal');
            const cardPaymentFields = document.getElementById('card_payment_fields');
            
            function togglePaymentFields() {
                if (paymentMethodCard.checked) {
                    cardPaymentFields.style.display = 'block';
                } else {
                    cardPaymentFields.style.display = 'none';
                }
            }
            
            paymentMethodCard.addEventListener('change', togglePaymentFields);
            paymentMethodPaypal.addEventListener('change', togglePaymentFields);
            
            // Initial toggle
            togglePaymentFields();
        });
    </script>
</x-app-layout>