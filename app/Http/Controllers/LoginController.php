<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => ['email'],
            'password' => ['gt:1'],
        ]);
        $credentials = $request->only('email', 'password');


        if (Auth::guard('user')->attempt($credentials)) {
            Auth::attempt($credentials);
            $token = JWTAuth::attempt($credentials);
            Session::put('JWT', $token);
            return redirect()->route('user.index');
        } else {
            return redirect()->route('user.login')->withErrors("Email or password is incorrect");
        }
    }

    public function getJWT(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'email' => ['email'],
            'password' => ['gt:1'],
        ]);
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            Auth::attempt($credentials);
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            return response()->json(['token' => $token], 200);
        }
    }
}
