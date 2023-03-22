<?php

namespace App\Services;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

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
        $token = new Token( $token);
        $payload = JWTAuth::decode($token);
        return User::find($payload['sub']);
    }
    public function save(){

    }
}
