<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('Goodi\User\index');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
