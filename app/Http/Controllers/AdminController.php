<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function loginPost(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::guard('admin')->attempt($credentials))
        {
            echo "Successfully logged in";exit;
        }
        else {echo "Login failed";exit;}
    }
}
