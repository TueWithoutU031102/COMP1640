<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CommentService;
use App\Services\EmailService;
use App\Services\IdeaService;
use App\Services\UserService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    protected UserService $userService;
    protected IdeaService $ideaService;
    protected EmailService $mailService;
    protected CommentService $commentService;


    protected User $currentUser;

    public function __construct(UserService  $userService,
                                EmailService $mailService,
                                IdeaService  $ideaService,
                                CommentService $commentService)
    {
        $this->userService = $userService;
        $this->ideaService = $ideaService;
        $this->mailService = $mailService;
        $this->commentService = $commentService;

        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->currentUser = Auth::user();
            }
            return $next($request);
        });
    }

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
