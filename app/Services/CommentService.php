<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    public function store(Comment $comment): bool
    {
        return $comment->save($comment);
    }

    public function finByid(int $commentId){
        return Comment::find($commentId);
    }
}
