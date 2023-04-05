<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Idea;
use App\Models\Submission;
use Carbon\Carbon;
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

    public function findByid(int $commentId){
        return Comment::find($commentId);
    }
    public function findByIdeaid(Idea $idea){
        return $idea->comments;
    }

    public function checkDueDateComment(int $submissionId){
        $duedateComment = Carbon::create(Submission::find($submissionId)->duedateComment);
        $now = Carbon::now();

        return $now->lt($duedateComment);
    }
}
