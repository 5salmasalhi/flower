<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        $products = [];
        $subtotal = 0;
        
        if (!empty($cartItems)) {
            $productIds = array_keys($cartItems);
            $productModels = Product::whereIn('id', $productIds)->get();
            
            foreach ($productModels as $product) {
                $quantity = $cartItems[$product->id];
                $itemSubtotal = $product->price * $quantity;
                $subtotal += $itemSubtotal;
                
                $products[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $itemSubtotal
                ];
            }
        }
        
        // Calculate shipping, tax, and total
        $shipping = 10.00; // Fixed shipping rate for simplicity
        $tax = $subtotal * 0.08; // 8% tax rate
        $total = $subtotal + $shipping + $tax;
        
        return view('checkout.index', compact('products', 'subtotal', 'shipping', 'tax', 'total'));
    }
    
    /**
     * Display the guest checkout page.
     */
    public function guest()
    {
        // Similar to index but with guest checkout form
        return $this->index();
    }
    
    /**
     * Process the checkout.
     */
    public function process(Request $request)
    {
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        // Validate checkout form
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'payment_method' => 'required|in:card,paypal',
            'notes' => 'nullable|string',
        ]);
        
        // Additional validation for card payments
        if ($request->payment_method === 'card') {
            $request->validate([
                'card_number' => 'required|string|max:19',
                'expiry_date' => 'required|string|max:7',
                'cvv' => 'required|string|max:4',
            ]);
        }
        
        // Calculate order totals
        $products = [];
        $subtotal = 0;
        
        $productIds = array_keys($cartItems);
        $productModels = Product::whereIn('id', $productIds)->get();
        
        foreach ($productModels as $product) {
            $quantity = $cartItems[$product->id];
            $itemSubtotal = $product->price * $quantity;
            $subtotal += $itemSubtotal;
            
            $products[] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'subtotal' => $itemSubtotal
            ];
        }
        
        $shipping = 10.00; // Fixed shipping rate
        $tax = $subtotal * 0.08; // 8% tax rate
        $total = $subtotal + $shipping + $tax;
        
        // Create the order
        try {
            DB::beginTransaction();
            
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(), // Will be null for guest checkout
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'status' => 'pending',
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'payment_method' => $validated['payment_method'],
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'tax' => $tax,
                'total' => $total,
                'notes' => $validated['notes'],
            ]);
            
            // Create order items
            foreach ($products as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['subtotal'],
                ]);
                
                // Update product stock
                $product = Product::find($item['product_id']);
                $product->stock -= $item['quantity'];
                $product->save();
            }
            
            DB::commit();
            
            // Clear the cart
            session()->forget('cart');
            
            // Redirect to thank you page
            return redirect()->route('checkout.thankyou', $order)->with('success', 'Your order has been placed successfully!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'There was an error processing your order. Please try again.');
        }
    }
    
    /**
     * Display the thank you page.
     */
    public function thankyou(Order $order)
    {
        // Ensure the order belongs to the current user or is a guest order with matching email
        // if (Auth::check() && $order->user_id !== Auth::id()) {
        //     abort(403);
        // } elseif (!Auth::check() && !session()->has('guest_order_' . $order->id)) {
        //     abort(403);
        // }
        
        return view('checkout.thankyou', compact('order'));
    }
}