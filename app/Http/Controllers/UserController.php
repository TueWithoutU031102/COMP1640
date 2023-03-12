<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\User;
use App\Services\IdeaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected IdeaService $ideaService;
    protected User $currentUser;

    public function __construct(IdeaService $ideaService)
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->currentUser = Auth::user();
            }
            return $next($request);
        });
        $this->ideaService = $ideaService;
    }
    public function index()
    {
        $listIdeas = $this->ideaService->findIdeasByUserId($this->currentUser);
        return view('Goodi/User/index')
            ->with('listIdeas', $listIdeas);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
