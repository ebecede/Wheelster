<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function viewHomePage()
    {
        return view('home');
    }

    public function register(Request $request)
    {
        // Handle registration logic
    }
}

