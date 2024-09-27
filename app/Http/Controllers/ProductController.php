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

    public function storeProduct(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'stock'=>'required|integer|min:1',
            'image' => 'required',
        ]);

        $file = $request->file('image');
        $path = time() . '_' . $request->name . "." . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        dump($validateData);

        $product = new Product();
        $product->name = $validateData['name'];
        $product->price = $validateData['price'];
        $product->description = $validateData['description'];
        $product->stock = $validateData['stock'];
        $product->image = $path;
        // $product->save();

        try {
            $product->save();
            return Redirect::route('products')->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Something went wrong while saving the product');
        }

        // return Redirect::route('products')->with('success', 'Product created successfully');
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

