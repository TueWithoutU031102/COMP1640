<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\User;
use App\Services\IdeaService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    protected IdeaService $ideaService;
    protected UserService $userService;
    protected User $currentUser;

    public function __construct(IdeaService $ideaService,UserService $userService)
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->currentUser = Auth::user();
            }
            return $next($request);
        });
        $this->userService = $userService;
        $this->ideaService = $ideaService;
    }
    public function index()
    {
        $listIdeas = $this->ideaService->findIdeasByUserId($this->currentUser);
        $JWT = Session::get('JWT');

        return view('Goodi/User/index')
            ->with('listIdeas', $listIdeas)
            ->with('JWT', $JWT);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
