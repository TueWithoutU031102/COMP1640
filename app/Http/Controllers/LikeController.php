<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;

class LikeController extends Controller
{
    //
    public function store(Idea $idea, Request $request)
    {
        $idea->likes()->create([
            'user_id' => $request->user()->id,
        ]);
        return back();
    }
}
