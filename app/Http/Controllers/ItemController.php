<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{

    public function viewAllItem()
    {
        $items = Item::paginate(12); // 12 items per page
        return view('products', compact('items'));
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('productDetail', compact('item'));
    }
}

