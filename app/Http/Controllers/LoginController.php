<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['email'],
            'password' => ['current_password','gt:1'],
        ]);
        $errors = ['current_password'=>'Email or password is incorrect'];
        return Auth::guard('admin')->attempt($credentials)
        ? redirect()->route('admin.index')
        : redirect()->route('admin.login')->withErrors($errors);
    }
}
