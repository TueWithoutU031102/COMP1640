<?php

namespace App\Services;

use App\Mail\EmailNotify;
use App\Models\Idea;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function submitIdeaNotify($dataInput): ?SentMessage
    {
        $submission = Submission::find($dataInput['submission_id']);
        $subject = $dataInput['from'] . ' has submitted an ideas for submission ' . $submission->title;
        $link = env('MEMCACHED_HOST', '127.0.0.1:8000') . '/submission/show/' . $submission->id;
        $content = $dataInput['from'] . ' in your department had submitted an idea to ' . $submission->title . '! You can check this submission: ';
        $to = User::where('role_id', 3)->pluck('email');
        $data = [
            'from' => $dataInput['from'],
            'to' => $to,
            'subject' => $subject,
            'link' => $link,
            'content' => $content
        ];
        $email = new EmailNotify($data);
        $email->to($data['to'])->with('data', $data);
        return Mail::send($email);
    }

    public function commentNotify($dataInput): ?SentMessage
    {
        $idea = Idea::find($dataInput['idea_id']);
        $from = $dataInput['from'];
        $subject = $from . ' has commented on your ideas: ' . $idea->title;
        $link = env('MEMCACHED_HOST', '127.0.0.1:8000') . '/submission/show/' . $idea->submission_id;
        $content = $from . ' comment an ideas! You can see your ideas submission: ';
        $to = User::find($idea->author_id)->email;

        $data = [
            'from' => $dataInput['from'],
            'to' => $to,
            'subject' => $subject,
            'link' => $link,
            'content' => $content
        ];

        $email = new EmailNotify($data);

        $email->to($data['to'])->with('data', $data);

        return Mail::send($email);
    }
}
