<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Enum;

class AdminController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        return Auth::guard('admin')->attempt($credentials)
            ? redirect()->route('admin.index')
            : redirect()->route('admin.login');
    }

    public function index()
    {
        return Auth::guard('admin')->check()
            ? to_route('admin.index')
            : to_route('admin.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function acc()
    {
        $users = User::all();
        return view('admin.acc', ['users' => $users]);
    }

    public function createAcc(Request $request)
    {
        $request['password'] = Hash::make($request['password']);
        $input = $request->all();
        User::create($input);
        return redirect('admin/acc')->with('flash_message', 'Create Successful!!!!!');
    }

    public function showAcc($id)
    {
        $account = User::find($id);
        return view('admin.showAcc')->with('account', $account);
    }
}
