<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Models\Idea;
use Tymon\JWTAuth\Facades\JWTAuth;


class LikeController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    //
    public function store(Idea $idea): \Illuminate\Http\JsonResponse
    {
        $user = JWTAuth::parseToken()->authenticate();
        $isLiked = false;
        if ($idea->likedBy($user)) {
            $user->likes()->where('idea_id', $idea->id)->delete();
        } else {
            $user->dislikes()->where('idea_id', $idea->id)->delete();
            $idea->likes()->create([
                'author_id' => $user->id,
            ]);
            $isLiked = true;
        }
        return response()->json([
            'likes' => $idea->likes()->count(),
            'dislikes' => $idea->dislikes()->count(),
            'isLiked' => $isLiked,
            'isDisliked' => $idea->dislikedBy($user),
        ], 200);
    }

//    public function destroy(Idea $ideas, Request $request)
//    {
//        $request->user()->likes()->where('idea_id', $ideas->id)->delete();
//        return back();
//    }
}
