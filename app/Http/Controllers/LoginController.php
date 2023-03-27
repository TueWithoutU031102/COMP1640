<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

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
            Session::put('jwt', $token);

            return redirect()->route('user.index');
        } else {
            return redirect()->route('user.login')->withErrors("Email or password is incorrect");
        }
    }

    public function generateJWT(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request, [
            'email' => ['email'],
            'password' => ['gt:1'],
        ]);
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Account not found!'], 404);
        } else {
            Auth::attempt($credentials);
            Session::put('JWT', $token);
            return response()->json(['token' => $token], 200);
        }
    }

    public function getCurrentUserFromJWT(Request $request):JsonResponse
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['user_not_found'], 404);
            }
            return response()->json(['user' => $user, 'role' => $user->role->name], 200);

        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired']);
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid']);
        } catch (JWTException $e) {
            return response()->json(['token_absent']);
        }
    }
}
