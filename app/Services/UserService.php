<?php

namespace App\Services;

use App\Models\User;

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
    public function save(){

    }
}
