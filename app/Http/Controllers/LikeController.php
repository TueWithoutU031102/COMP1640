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

        if ($idea->likedBy($user)){
            $user->likes()->where('idea_id', $idea->id)->delete();
        } else {
            $user->dislikes()->where('idea_id', $idea->id)->delete();
            $idea->likes()->create([
                'author_id' => $user->id,
            ]);
        }
        return response()->json([
            'likes' => $idea->likes()->count(),
            'dislikes' => $idea->dislikes()->count(),
            'isLiked' => true,
        ], 200);
    }

//    public function destroy(Idea $idea, Request $request)
//    {
//        $request->user()->likes()->where('idea_id', $idea->id)->delete();
//        return back();
//    }
}
