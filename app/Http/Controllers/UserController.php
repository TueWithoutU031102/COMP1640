<?php

namespace App\Http\Controllers;

use App\Services\IdeaService;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
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

        $account = User::find(Auth::user()->id);
        $listRoles = Role::where('name', '!=', 'ADMIN')->get();
        $listDepartments = Department::all();
        $listIdeas = $this->ideaService->findIdeasByUserId($this->currentUser);
        return view(
            'Goodi/User/index',
            [
                'listIdeas' => $listIdeas,
                'account' => $account,
                'listRoles' => $listRoles,
                'listDepartments' => $listDepartments
            ]
        );
    }
}
