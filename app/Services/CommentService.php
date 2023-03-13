<?php

namespace App\Services;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentService
{
    public function findAll(): Collection
    {
        return Comment::all();
    }
    public function store(Comment $comment): bool
    {
        return $comment->save();
    }

    public function finByid(int $commentId){
        return Comment::find($commentId);
    }
}
