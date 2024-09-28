<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __contruct()
    {
        this->middleware('auth');
    }

    // Customer
    public function make_order(Product $product, Request $request)
    {

        $request->validate([
            'vehicleName' => 'required',
            'steeringWheelPhoto' => 'required',
            'scheduleDate' => 'required',
        ]);

        $user_id = Auth::id();
        $product_id = $product->id;
        $amount = $product->price;
        $status = 'In Progress';

        $file = $request->file('steeringWheelPhoto');
        $path = time() . '_' . $request->name . "." . $file->getClientOriginalExtension();

        Storage::disk('public')->put('public/' . $path, file_get_contents($file));

        Order::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'vehicleName' => $request->vehicleName,
            'steeringWheelPhoto' => $path,
            'scheduleDate' => $request->scheduleDate,
            'amount' => $amount,
            'status' => $status,
        ]);

        return Redirect::route('index_product');
    }

    public function show_order()
    {
        $user_id = Auth::id();
        $orders = Order::where('user_id', $user_id)->get();
        return view('order.show_order', compact('orders'));
    }

    public function reschedule(Order $order)
    {
        return view('order.reschedule', compact('order'));
    }

    // public function edit_order(Order $oder)
    // {
    //     return view('order.edit_order', compact('oder'));
    // }

    public function reschedule_order(Order $order, Request $request)
    {
        $request->validate([
            'scheduleDate' => 'required',
        ]);

        $order->update([
            'scheduleDate' => $request->scheduleDate,
        ]);

        return Redirect::route('show_order');
    }

    public function cancel_order(Order $order)
    {
        $order->update(['status' => 'Cancelled']);
        return Redirect::route('show_order');
    }

    // ADMIN
    public function show_all_order()
    {
        $orders = Order::with('product')->paginate(10);
        return view('order.show_all_order', compact('orders'));
    }

    public function show_order_detail(Order $order)
    {
        return view('order.order_detail', compact('order'));
    }

    public function cancel_order_admin(Order $order)
    {
        $order->update(['status' => 'Cancelled']);
        return Redirect::route('show_all_order');
    }

    public function complete_order_admin(Order $order)
    {
        $order->update(['status' => 'Complete']);
        return Redirect::route('show_all_order');
    }


    // public function viewAllorder()
    // {
    //     $orders = order::paginate(12); // 12 orders per page
    //     return view('order.orders', compact('orders'));
    // }



}

