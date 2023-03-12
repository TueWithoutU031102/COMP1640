<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthenController extends Controller
{
    public function getCsrfToken(Request $request): string
    {
        $token = csrf_token();
        Session::put('_token', $token); // Lưu token vào session để sử dụng trong các request khác
        return $token;
    }
}
