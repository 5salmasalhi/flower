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
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 ">
                                <thead class="bg-gray-50 ">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                            Product
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                            Price
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                            Stock
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                            Featured
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500  uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white  divide-y divide-gray-200 ">
                                    @forelse ($products as $product)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        @if ($product->image)
                                                            <img class="h-10 w-10 rounded-full object-cover"
                                                                src="{{ asset('storage/' . $product->image) }}"
                                                                alt="{{ $product->name }}">
                                                        @else
                                                            <div
                                                                class="h-10 w-10 rounded-full bg-gray-200  flex items-center justify-center">
                                                                <span class="text-xs text-gray-500 ">No img</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900 ">
                                                            {{ $product->name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500 ">
                                                            {{ Str::limit($product->description, 50) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 ">
                                                ${{ number_format($product->price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 ">
                                                {{ $product->stock }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($product->is_active)
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800  ">
                                                        Active
                                                    </span>
                                                @else
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800  ">
                                                        Inactive
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($product->is_featured)
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800  ">
                                                        Featured
                                                    </span>
                                                @else
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800  ">
                                                        Not Featured
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('admin.products.show', $product) }}"
                                                    class="text-indigo-600 hover:text-indigo-900   mr-3">View</a>
                                                <a href="{{ route('admin.products.edit', $product) }}"
                                                    class="text-pink-600 hover:text-pink-900   mr-3">Edit</a>
                                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900  "
                                                        onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6"
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-500  text-center">
                                                No products found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection