<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IdeaService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    protected IdeaService $ideaService;
    protected User $currentUser;
    public function __construct(IdeaService $ideaService)
    {
        $this->ideaService = $ideaService;
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->currentUser = Auth::user();
            }
            return $next($request);
        });
    }
    public function index()
    {
        $listIdeas = $this->ideaService->findIdeasByUserId($this->currentUser);
        return view('Goodi/User/index')
            ->with('listIdeas', $listIdeas);
    }

    
}
