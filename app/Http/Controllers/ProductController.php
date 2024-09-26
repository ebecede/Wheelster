<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{

    public function viewAllProduct()
    {
        $products = Product::paginate(12); // 12 Products per page
        return view('product.products', compact('products'));
    }

    public function viewDetailProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('product.productDetail', compact('product'));
    }
}

