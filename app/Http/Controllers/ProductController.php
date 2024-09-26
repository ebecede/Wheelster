<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    // ADD PRODUCT
    public function createProduct()
    {
        return view('product.create_product');
    }

    public function storeProduct()
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
            'stock'=>'required'
        ]);

        $file = $request->file('image');
        $path = time() . '_' . $request->name . "." . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path,
            'price' => $request->price,
            'stock' => $request->stock
        ]);

        return Redirect::route('create_product');
    }

    // SHOW PRODUCT
    public function viewAllProduct()
    {
        $products = Product::paginate(12); // 12 Products per page
        return view('product.products', compact('products'));
    }

    public function viewDetailProduct(Product $product)
    {
        return view('product.product_detail', compact('product'));
    }

    // EDIT PRODUCT
    public function editProduct(Product $product)
    {
        return view('product.edit_product', compact('product'));
    }

    // DELETE PRODUCT
    public function deleteProduct(Product $product)
    {
        $product->delete();
        return Redirect::route('products');
    }
}

