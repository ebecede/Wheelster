<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    public function viewAdminHome()
    {
        return view('admin.admin_home');
    }


}
