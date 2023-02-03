<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createAcc()
    {
        $data['title'] = 'Create Account';
        return view('admin/createAcc', $data);
    }
}
