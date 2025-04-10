<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function index()
    {
        $cartItems = session()->get('cart', []);
        $products = [];
        $total = 0;
        
        if (!empty($cartItems)) {
            $productIds = array_keys($cartItems);
            $productModels = Product::whereIn('id', $productIds)->get();
            
            foreach ($productModels as $product) {
                $quantity = $cartItems[$product->id];
                $subtotal = $product->price * $quantity;
                $total += $subtotal;
                
                $products[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ];
            }
        }
        
        return view('cart.index', compact('products', 'total'));
    }
    
    /**
     * Add a product to the cart.
     */
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);
        
        $quantity = $request->quantity;
        $cart = session()->get('cart', []);
        
        // If product already in cart, update quantity
        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        } else {
            $cart[$product->id] = $quantity;
        }
        
        // Ensure quantity doesn't exceed stock
        if ($cart[$product->id] > $product->stock) {
            $cart[$product->id] = $product->stock;
        }
        
        session()->put('cart', $cart);
        
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    
    /**
     * Update the quantity of a product in the cart.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $product->stock,
        ]);
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id] = $request->quantity;
        }
        
        session()->put('cart', $cart);
        
        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }
    
    /**
     * Remove a product from the cart.
     */
    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }
        
        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
    
    /**
     * Clear the entire cart.
     */
    public function clear()
    {
        session()->forget('cart');
        
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }
    
    /**
     * Proceed to checkout.
     */
    public function checkout()
    {
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        
        // If user is logged in, redirect to checkout page
        if (Auth::check()) {
            return redirect()->route('checkout.index');
        }
        
        // If guest checkout is allowed, redirect to guest checkout
        return redirect()->route('checkout.guest');
    }
}