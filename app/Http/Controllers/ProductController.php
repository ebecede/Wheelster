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
        // Validation with custom messages
        $request->validate(
            [
                'name' => 'required',
                'brand_id' => 'required',
                'price' => 'required|numeric|min:1',
                'description' => 'required',
                'stock' => 'required|integer|min:0',
                'image' => 'required|file|mimes:jpeg,png,jpg,gif|max:5000',
            ],
            [
                'name.required' => 'The product name is required.',
                'brand_id.required' => 'Please select a brand.',
                'price.required' => 'The product price is required.',
                'price.numeric' => 'The price must be a number.',
                'price.min' => 'The price must be at least 1.',
                'description.required' => 'The product description is required.',
                'stock.required' => 'The stock field is required.',
                'stock.integer' => 'The stock must be an integer.',
                'stock.min' => 'The stock cannot be negative.',
                'image.required' => 'Please upload an image for the product.',
                'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
                'image.max' => 'The image size must not exceed 5MB.',
            ]
        );

        // Process the file upload
        $file = $request->file('image');
        $path = time() . '_' . $request->name . "." . $file->getClientOriginalExtension();

        Storage::disk('public')->put('public/' . $path, file_get_contents($file));

        // Create the product
        Product::create([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'image' => $path,
        ]);

        // Redirect to the admin product index page
        return Redirect::route('index_product_admin');
    }


    public function index_product(Request $request)
    {
        // Fetch all available brands for the filter dropdown
        $brands = Brand::all();

        // Check if the user selected a brand for filtering
        $brand_id = $request->input('brand');

        if ($brand_id) {
            // Filter products by the selected brand
            $products = Product::where('brand_id', $brand_id)->paginate(5);
        } else {
            // Display all products if no brand is selected
            $products = Product::paginate(12);
        }

        // Return the view with products and brands data
        return view('product.index_product', compact('products', 'brands', 'brand_id'));
    }


    public function index_product_admin()
    {
        $products = Product::paginate(10);
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
        $customMessages = [
            'name.required' => 'Please enter the product name.',
            'brand_id.required' => 'Please select a brand.',
            'price.required' => 'Please specify the product price.',
            'description.required' => 'Please provide a product description.',
            'stock.required' => 'Please enter the stock quantity.',
            'image.mimes' => 'The photo must be a file of type: jpg, jpeg, png, webp, heic.',
            'image.max' => 'The image size must not exceed 5 MB.',
        ];

        $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp,heic|max:5000',
        ], $customMessages);

        $data = [
            'name' => $request->name,
            'brand_id' => $request->brand_id,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = time() . '_' . $request->name . "." . $file->getClientOriginalExtension();

            Storage::disk('public')->put('public/' . $path, file_get_contents($file));
            $data['image'] = $path;
        } else {
            $data['image'] = $product->image;
        }

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

