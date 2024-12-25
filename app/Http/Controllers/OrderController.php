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
    // CUSTOMER
    public function make_order(Product $product, Request $request)
    {
        $request->validate([
            'vehicleName' => 'required',
            'steeringWheelPhoto' => 'required|file|mimes:jpg,jpeg,png,webp,heic|max:5000', // 10240 KB = 10 MB
            'scheduleDate' => 'required',
            'scheduleTime' => 'required',
        ], [
            'vehicleName.required' => 'Vehicle Name and Model is required.',
            'steeringWheelPhoto.required' => 'Car Steering Wheel Photo is required.',
            'steeringWheelPhoto.mimes' => 'The photo must be a file of type: jpg, jpeg, png, webp, heic.',
            'steeringWheelPhoto.max' => 'The photo size must not exceed 5 MB.',
            'scheduleDate.required' => 'Schedule Date is required.',
            'scheduleTime.required' => 'Schedule Time is required.',
        ]);

        $user_id = Auth::id();
        $product_id = $product->id;
        $status = 'In Progress';

        // Cek apakah jumlah order sudah mencapai batas maksimal di sesi yang dipilih
        $maxOrder = $request->scheduleTime === '17:00 - 18:00' ? 1 : 2;
        $orderCount = Order::where('scheduleDate', $request->scheduleDate)
                            ->where('scheduleTime', $request->scheduleTime)
                            ->count();

        if ($orderCount >= $maxOrder) {
            return back()->withErrors(['scheduleTime' => 'The selected session is fully booked. Please choose another time.'])->withInput();
        }

        $file = $request->file('steeringWheelPhoto');
        $path = time() . '_' . $request->name . "." . $file->getClientOriginalExtension();
        Storage::disk('public')->put('public/' . $path, file_get_contents($file));

        Order::create([
            'user_id' => $user_id,
            'product_id' => $product_id,
            'vehicleName' => $request->vehicleName,
            'steeringWheelPhoto' => $path,
            'scheduleDate' => $request->scheduleDate,
            'scheduleTime' => $request->scheduleTime,  // Tambahkan scheduleTime
            'status' => $status,
        ]);

        $product->stock -= 1;
        $product->save();

        return Redirect::route('show_order');
    }


    public function checkAvailability(Request $request)
    {
        $scheduleDate = $request->input('scheduleDate');
        $timeSlots = [
            '09:00 - 11:00' => 2,
            '11:00 - 13:00' => 2,
            '13:00 - 15:00' => 2,
            '15:00 - 17:00' => 2,
            '17:00 - 18:00' => 1,
        ];

        $availability = [];

        foreach ($timeSlots as $time => $maxOrder) {
            // Count current orders that are not canceled
            $orderCount = Order::where('scheduleDate', $scheduleDate)
                                ->where('scheduleTime', $time)
                                ->where('status', '!=', 'Cancelled') // Exclude canceled orders
                                ->count();

            $availability[$time] = max($maxOrder - $orderCount, 0);
        }

        return response()->json($availability);
    }


    public function show_order()
    {
        $user_id = Auth::id();
        // Ambil order yang sudah di-soft delete
        $orders = Order::where('user_id', $user_id)
                        ->orderBy('updated_at', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->withTrashed() // Mengambil order yang sudah di-soft delete
                        ->get();

        return view('order.show_order', compact('orders'));
    }


    public function reschedule(Order $order)
    {
        return view('order.reschedule', compact('order'));
    }

    public function reschedule_order(Order $order, Request $request)
    {
        $request->validate([
            'scheduleDate' => 'required|date',
            'scheduleTime' => 'required',
        ]);

        // Check if the selected time slot is available
        $maxOrder = $request->scheduleTime === '17:00 - 18:00' ? 1 : 2;
        $orderCount = Order::where('scheduleDate', $request->scheduleDate)
                        ->where('scheduleTime', $request->scheduleTime)
                        ->where('status', '!=', 'Cancelled')
                        ->count();

        if ($orderCount >= $maxOrder) {
            return back()->withErrors(['scheduleTime' => 'The selected session is fully booked. Please choose another time.']);
        }

        // Update the order with the new schedule
        $order->update([
            'scheduleDate' => $request->scheduleDate,
            'scheduleTime' => $request->scheduleTime,
        ]);

        return Redirect::route('show_order');
    }

    public function cancel_order(Order $order)
    {
        $order->delete();
        $order->update(['status' => 'Cancelled']);
        $order->product->increment('stock', 1);
        return Redirect::route('show_order');
    }

    // ADMIN
    public function show_all_order(Request $request)
    {
        $query = Order::with('product', 'user'); // Eager load related models

        // Apply filter if the 'month' parameter is provided
        if ($request->has('month') && $request->month != null) {
            $query->whereMonth('scheduleDate', '=', date('m', strtotime($request->month)))
                  ->whereYear('scheduleDate', '=', date('Y', strtotime($request->month)));
        }

        $orders = $query->orderBy('id', 'desc')->withTrashed()->paginate(10);
        // $orders = Order::with('product')->orderBy('scheduleDate', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        return view('order.show_all_order', compact('orders'));
    }

    public function show_order_detail($id)
    {
        $order = Order::withTrashed()->findOrFail($id);
        return view('order.order_detail', compact('order'));
    }

    public function cancel_order_admin(Order $order)
    {
        $order->delete();
        $order->update(['status' => 'Cancelled']);
        $order->product->increment('stock', 1);
        return Redirect::route('show_all_order');
    }

    public function complete_order_admin(Order $order)
    {
        $order->update(['status' => 'Complete']);
        app(InvoiceController::class)->create_invoice($order);
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
            'steeringWheelPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000', // Optional image upload
        ]);

        // Check if the product has been changed
        $oldProduct = $order->product; // Get the old product from the order
        $newProduct = Product::find($request->product_id); // Get the new product

        // Prepare data for update
        $data = [
            'vehicleName' => $request->vehicleName,
            'scheduleDate' => $request->scheduleDate,
            'product_id' => $request->product_id,
        ];

        // Update the photo if a new one is provided
        if ($request->hasFile('steeringWheelPhoto')) {
            $file = $request->file('steeringWheelPhoto');
            $path = time() . '_steeringWheelPhoto_' . $order->id . "." . $file->getClientOriginalExtension();

            Storage::disk('public')->put('public/' . $path, file_get_contents($file));
            $data['steeringWheelPhoto'] = $path;
        } else {
            $data['steeringWheelPhoto'] = $order->steeringWheelPhoto;
        }

        // Update stock for old and new product
        if ($oldProduct->id != $newProduct->id) {
            // Increase stock of the old product
            $oldProduct->stock += 1;
            $oldProduct->save();

            // Decrease stock of the new product
            $newProduct->stock -= 1;
            $newProduct->save();
        }

        // Update the order with the new data
        $order->update($data);

        return Redirect::route('show_all_order');
    }

    // Display the order list with filtering by month
    public function index(Request $request)
    {
        $query = Order::with('user', 'product')->withTrashed();

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

        // Check if a month is provided
        if ($month) {
            $monthFormatted = date('F_Y', strtotime($month)); // Format month as 'Month_Year'
            $fileName = "{$monthFormatted}_Report.xlsx";
        } else {
            $fileName = 'Report.xlsx';
        }

        return Excel::download(new OrderExport($month), $fileName);
    }


}

