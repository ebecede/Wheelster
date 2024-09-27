<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function create_order(Product $product)
    {
        return view('order.create_order', compact('product'));
    }

    public function store_order(Request $request)
    {

        $request->validate([
            'vehicleName' => 'required',
            'steeringWheelPhoto' => 'required',
            'scheduleDate' => 'required',
            'product_id' => 'required|exists:products,id',
        ]);

        $file = $request->file('steeringWheelPhoto');
        $path = time() . '_' . $request->name . "." . $file->getClientOriginalExtension();

        Storage::disk('public')->put('public/' . $path, file_get_contents($file));

        Order::create([
            'vehicleName' => $request->vehicleName,
            'steeringWheelPhoto' => $path,
            'scheduleDate' => $request->scheduleDate,
            'product_id' => $request->product_id,
        ]);

        return Redirect::route('index_product');
    }
    
    public function viewAllOrders()
    {
        $orders = Order::with('product')->paginate(10);
        return view('admin.admin_order', compact('orders'));
    }

    public function viewAllorder()
    {
        $orders = order::paginate(12); // 12 orders per page
        return view('order.orders', compact('orders'));
    }



}

