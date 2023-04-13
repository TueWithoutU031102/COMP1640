<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
use Tymon\JWTAuth\Facades\JWTAuth;

class DislikeController extends Controller
{
    //
    public function store(Idea $idea)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($idea->dislikedBy($user)){
            $user->dislikes()->where('idea_id', $idea->id)->delete();
        } else {
            $user->likes()->where('idea_id', $idea->id)->delete();
            $idea->dislikes()->create([
                'author_id' => $user->id,
            ]);
        }
        return response()->json([
            'likes' => $idea->likes()->count(),
            'dislikes' => $idea->dislikes()->count(),
            'isLiked' => false,
        ], 200);
    }
}
