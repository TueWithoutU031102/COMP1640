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
        $subject = $dataInput['from'] . ' has submitted an idea for submission ' . $submission->title;
        $link = env('MEMCACHED_HOST', '127.0.0.1') . ':8000/submission/show/' . $submission->id;
        $content = $dataInput['from'] . ' had submitted an idea! You can see your idea submission: ';
        $to = User::find($submission->author_id)->email;

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
        $subject = $from . ' has commented on your idea: ' . $idea->title;
        $link = env('MEMCACHED_HOST', '127.0.0.1') . ':8000/submission/show/' . $idea->submission_id;
        $content = $from . ' comment an idea! You can see your idea submission: ';
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
