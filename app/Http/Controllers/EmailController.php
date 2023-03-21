<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\EmailService;
use App\Services\IdeaService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    protected User $currentUser;
    protected EmailService $emailService;
    protected UserService $userService;

    public function __construct(EmailService $emailService, UserService $userService)
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->currentUser = Auth::user();
            }
            return $next($request);
        });
        $this->emailService = $emailService;
        $this->userService = $userService;
    }


    public function sentEmail(Request $request): JsonResponse
    {
        $jwt = $request->bearerToken();
        $data = [
            'from' => $this->userService->findUserByToken($jwt)->name,
            'submission_id' => 3,
        ];

        $this->emailService->submitIdeaNotify($data);
        return response()->json([
            'message' => 'Email sent',
            'comment' => $data,
        ], 200);
    }
}
