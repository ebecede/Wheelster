<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Product;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function create_invoice(Order $order){

        $product  = Product::where('id', $order->product_id)->first();
        Invoice :: create([
            'order_id'=> $order->id,
            'amount' => $product->price,
            'paymentDate' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s')
        ]);
    }
}
