<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function create_product()
    {
        return view('product.create_product');
    }

    public function store_product(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'stock'=>'required',
            'image' => 'required',
        ]);

        $file = $request->file('image');
        $path = time() . '_' . $request->name . "." . $file->getClientOriginalExtension();

        Storage::disk('public')->put('public/' . $path, file_get_contents($file));

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'image' => $path,
        ]);

        return Redirect::route('index_product_admin');
    }

    public function index_product()
    {
        $products = Product::paginate(5);
        return view('product.index_product', compact('products'));
    }

    public function index_product_admin()
    {
        $products = Product::paginate(5);
        return view('product.index_product_admin', compact('products'));
    }

    public function show_product(Product $product)
    {
        return view('product.show_product', compact('product'));
    }

    public function edit_product(Product $product)
    {
        return view('product.edit_product', compact('product'));
    }

    public function update_product(Product $product, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'stock'=>'required',
            'image' => 'required',
        ]);

        $file = $request->file('image');
        $path = time() . '_' . $request->name . "." . $file->getClientOriginalExtension();

        Storage::disk('public')->put('public/' . $path, file_get_contents($file));

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'image' => $path,
        ]);

        return Redirect::route('index_product_admin', $product);
    }

    // DELETE PRODUCT
    public function delete_product(Product $product)
    {
        $product->delete();
        return Redirect::route('index_product_admin');
    }

    // SHOW PRODUCT ADMIN
    // public function viewAllProductAdmin()
    // {
    //     $products = Product::paginate(5); // 12 Products per page
    //     return view('admin.admin_products', compact('products'));
    // }
}

