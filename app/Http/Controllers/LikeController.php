<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class LikeController extends Controller
{
    //
    public function store(Idea $idea, Request $request)
    {
        if ($idea->likedBy($request->user()))
            return response(null, 409);

        $idea->likes()->create([
            'author_id' => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Idea $idea, Request $request)
    {
        $request->user()->likes()->where('idea_id', $idea->id)->delete();
        return back();
    }
}
