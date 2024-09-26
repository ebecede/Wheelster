<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function makeOrder(Request $request)
    {
        // Handle order creation logic
    }

    public function viewAllOrders()
    {
        $orders = Order::with('product')->paginate(10);
        return view('admin.admin_order', compact('orders'));
    }

    public function viewAllProduct()
    {
        $products = Product::paginate(12); // 12 Products per page
        return view('product.products', compact('products'));
    }
}

