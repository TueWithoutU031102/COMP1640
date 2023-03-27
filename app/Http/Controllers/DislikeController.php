<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class DislikeController extends Controller
{
    //
    public function store(Idea $idea, Request $request)
    {
        if ($idea->dislikedBy($request->user()))
            return response(null, 409);
        $request->user()->likes()->where('idea_id', $idea->id)->delete();
        $idea->dislikes()->create([
            'author_id' => $request->user()->id,
        ]);

        return back();
    }

    public function destroy(Idea $idea, Request $request)
    {
        $request->user()->dislikes()->where('idea_id', $idea->id)->delete();
        return back();
    }
}
