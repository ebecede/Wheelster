<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function viewHomePage()
    {
        return view('home');
    }

    public function viewAdminHome()
    {
        return view('admin.admin_home');
    }
}
