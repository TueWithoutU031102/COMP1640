<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\Rules\Password;

class LoginController extends Controller
{

    private UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::guard('user')->attempt($credentials)) {
            Auth::attempt($credentials);
            $token = JWTAuth::attempt($credentials);
            Session::put('jwt', $token);
            return redirect()->route('userIndex');
        } else {
            return redirect()->route('user.login')->withErrors("Email or password is incorrect");
        }
    }

    public function loginAPI(Request $request): JsonResponse
    {
        $token = $this->userService->generateJWT($request);
        $user = $this->userService->findUserByToken($token);
        return response()->json(['user' => $user, 'token' => $token], 200);
    }
}
