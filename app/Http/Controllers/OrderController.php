<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderExport;

class OrderController extends Controller
{
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

    public function edit_order(Order $order){
        $products = Product::all();
        $product  = Product::where('id', $order->product_id)->first();
        return view('order.edit_order', compact('order','products','product'));
    }

    public function update_order(Order $order, Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'vehicleName' => 'required|string',
            'scheduleDate' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'steeringWheelPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Make this nullable and allow image upload
        ]);

        $data = [
            'vehicleName' => $request->vehicleName,
            'scheduleDate' => $request->scheduleDate,
            'product_id' => $request->product_id,
        ];

        if ($request->hasFile('steeringWheelPhoto')) {
            $file = $request->file('steeringWheelPhoto');
            $path = time() . '_steeringWheelPhoto_' . $order->id . "." . $file->getClientOriginalExtension();

            Storage::disk('public')->put('public/' . $path, file_get_contents($file));
            $data['steeringWheelPhoto'] = $path;
        } else {
            $data['steeringWheelPhoto'] = $order->steeringWheelPhoto;
        }

        $order->update($data);

        return Redirect::route('show_all_order');
    }

    // Display the order list with filtering by month
    public function index(Request $request)
    {
        $query = Order::with('user', 'product');

        // Filter by month and year if selected
        if ($request->has('month')) {
            $selectedMonth = $request->month;
            $query->whereYear('scheduleDate', '=', date('Y', strtotime($selectedMonth)))
                  ->whereMonth('scheduleDate', '=', date('m', strtotime($selectedMonth)));
        }

        $orders = $query->paginate(10);

        return view('order.show_all_order', compact('orders'));
    }

    // Export the orders to Excel based on the month filter
    public function export_report(Request $request)
    {
        $month = $request->input('month');

        return Excel::download(new OrderExport($month), 'orders_report.xlsx');
    }
}

