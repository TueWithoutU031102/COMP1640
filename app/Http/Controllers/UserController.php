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
        $this->ideaService = $ideaService;
    }
    public function index()
    {
        $listIdeas = $this->ideaService->findIdeasByUserId(Auth::user());
        return view('Goodi/User/index')
            ->with('listIdeas', $listIdeas);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
