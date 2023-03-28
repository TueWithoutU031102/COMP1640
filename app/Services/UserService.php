<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;
use Illuminate\Support\Facades\DB;

class UserService
{

    public function findAll(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all();
    }
    public function find($id)
    {
        return User::find($id);
    }

    public function findUserByToken($token): User
    {
        $token = new Token($token);
        $payload = JWTAuth::decode($token);
        return User::find($payload['sub']);
    }

    public function generateJWT(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return null;
        } else {
            Auth::attempt($credentials);
            Session::put('JWT', $token);
            return $token;
        }
    }
    public function checkDuplicateEmail($email): bool
    {
        $checkEmail = DB::table('users')->where('email', '=', $email)->exists();
        return $checkEmail;
    }

    public function checkDuplicatePhone($phone)
    {
        $checkPhone = DB::table('users')->where('phone_number', '=', $phone)->exists();
        return $checkPhone;
    }
    public function save()
    {
    }
}
