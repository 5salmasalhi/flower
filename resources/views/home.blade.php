<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to Flower Shop') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 p-4">
                            <h1 class="text-3xl font-bold text-gray-800 mb-4">Beautiful Flowers for Every Occasion</h1>
                            <p class="text-gray-600 mb-6">Discover our wide selection of fresh flowers, bouquets, and arrangements perfect for any event or to brighten someone's day.</p>
                            <a href="{{ route('products.index') }}" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded">
                                Shop Now
                            </a>
                        </div>
                        <div class="md:w-1/2 p-4">
                            <img src="{{ asset('storage/hero-image.jpg') }}" alt="Beautiful flower arrangement" class="rounded-lg shadow-md">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Products -->
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Featured Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse ($featuredProducts as $product)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                        <a href="{{ route('products.show', $product) }}">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No image</span>
                                </div>
                            @endif
                        </a>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                            <p class="text-gray-600 mt-1">${{ number_format($product->price, 2) }}</p>
                            <div class="mt-4">
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded">
                                        Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-500">No featured products available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>