<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function create_product()
    {
        $brands = Brand::all();
        return view('product.create_product',compact('brands'));
    }

    public function store_product(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
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
            'brand_id' => $request->brand_id,
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
        $brands = Brand::all();
        return view('product.edit_product', compact('product','brands'));
    }

    public function update_product(Product $product, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Make this nullable
        ]);

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
        ];

        // Check if a new image was uploaded
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = time() . '_' . $request->name . "." . $file->getClientOriginalExtension();

            // Store the new image
            Storage::disk('public')->put('public/' . $path, file_get_contents($file));
            $data['image'] = $path; // Update the image path in data
        } else {
            // Keep the existing image if no new image was uploaded
            $data['image'] = $product->image;
        }

        // Update the product
        $product->update($data);

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

