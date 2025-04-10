<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;

class DashboardController extends AdminController
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $recentOrders = Order::latest()->take(5)->get();
        $lowStockProducts = Product::where('stock', '<', 5)->where('is_active', true)->get();
        
        return view('admin.dashboard', compact(
            'totalProducts',
            'totalOrders',
            'recentOrders',
            'lowStockProducts'
        ));
    }
}