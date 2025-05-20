@extends($layout ?? 'layouts.admin')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900 ">Show Order</h1>
        </div>

        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Order Information</h3>
                                <div class="mt-4 space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Order Number:</span>
                                        <span class="font-medium">{{ $order->order_number }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Date:</span>
                                        <span>{{ $order->created_at->format('M d, Y h:i A') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Status:</span>
                                        <span>
                                            @if ($order->status == 'pending')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @elseif ($order->status == 'processing')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    Processing
                                                </span>
                                            @elseif ($order->status == 'completed')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Completed
                                                </span>
                                            @elseif ($order->status == 'cancelled')
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Cancelled
                                                </span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Total:</span>
                                        <span class="font-medium">${{ number_format($order->total, 2) }}</span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Customer Information</h3>
                                <div class="mt-4 space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Name:</span>
                                        <span>{{ $order->customer_name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Email:</span>
                                        <span>{{ $order->customer_email }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Phone:</span>
                                        <span>{{ $order->customer_phone ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Address:</span>
                                        <span class="text-right">
                                            {{ $order->address }}<br>
                                            {{ $order->city }}, {{ $order->state ?? '' }} {{ $order->postal_code }}<br>
                                            {{ $order->country }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Order Items</h3>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Product
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Price
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Quantity
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Subtotal
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($order->products as $product)
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
                                                                class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                                <span class="text-xs text-gray-500">No img</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $product->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                ${{ number_format($product->pivot->price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $product->pivot->quantity }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                ${{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="3"
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-right">
                                            Total:
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            ${{ number_format($order->total, 2) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        @if ($order->notes)
                            <div class="mt-6">
                                <h4 class="text-md font-medium text-gray-900">Order Notes</h4>
                                <div class="mt-2 p-4 bg-gray-50 rounded-md">
                                    {{ $order->notes }}
                                </div>
                            </div>
                        @endif

                        <div class="mt-6">
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline"
                                onsubmit="return confirm('Are you sure you want to delete this order? This action cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection