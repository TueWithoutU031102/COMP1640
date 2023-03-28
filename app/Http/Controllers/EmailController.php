<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CommentService;
use App\Services\EmailService;
use App\Services\IdeaService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    protected UserService $userService;
    protected EmailService $mailService;
    public function __construct(UserService  $userService,
                                EmailService $mailService)
    {
        $this->userService = $userService;
        $this->mailService = $mailService;
    }

    public function sentIdeaSubmitNotifyEmail(Request $request): JsonResponse
    {
        $data = [
            'from' => $request->get('from'),
            'submission_id' => $request->get('submission_id'),
        ];

        return response()->json([
            'message' => $this->mailService->submitIdeaNotify($data),
            'data' => $data,
        ], 200);
    }

    public function sentCommentNotifyEmail(Request $request): JsonResponse
    {
        $data = [
            'from' => $request->get('from'),
            'idea_id' => $request->get('idea_id'),
        ];

        return response()->json([
            'message' => $this->mailService->commentNotify($data),
            'data' => $data,
        ], 200);
    }
}
