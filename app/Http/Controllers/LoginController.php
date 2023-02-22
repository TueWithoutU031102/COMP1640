<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => ['email'],
            'password' => ['gt:1'],
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            Auth::
            dd(Auth::user());
            return redirect()->route('admin.index');
        } else {
            return redirect()->route('admin.login')->withErrors("Email or password is incorrect");
        }
    }
}
