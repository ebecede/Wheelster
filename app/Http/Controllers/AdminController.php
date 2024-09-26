<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    public function viewAllProduct()
    {
        $products = Product::paginate(5); // 12 Products per page
        return view('admin.admin_products', compact('products'));
    }
}
