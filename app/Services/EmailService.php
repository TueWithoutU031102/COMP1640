<?php

namespace App\Services;

use App\Mail\EmailNotify;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Mail\SentMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;

class EmailService
{
    public function submitIdeaNotify($dataInput): ?SentMessage
    {
        $submission = Submission::find($dataInput['submission_id']);
        $from = $dataInput['from'];
        $subject = $from . ' has submitted an idea for submission ' .$submission->title;
        $link = env('MEMCACHED_HOST', '127.0.0.1') . ':8000/submission/show/' .$submission->id;
        $content = $from.' had submitted an idea! You can see your idea submission: ';
        $to = User::find($submission->author_id)->email;

        $data = [
            'from'=>$from,
            'to' => $to,
            'subject' => $subject,
            'link' => $link,
            'content'=>$content
        ];

        $email = new EmailNotify($data);

        $email->to($data['to'])->with('data', $data);

        return Mail::send($email);
    }

    public function commentNotify($data): ?SentMessage
    {

        $data = [
            'name' => 'John Doe',
            'receiver' => 'johndoe@example.com',
            'subject' => '@someone had comment on your idea',
            'message' => 'This is a test email.',
        ];

        $email = new EmailNotify($data);

        $email->to($data['receiver'])->with('data', $data);

        return Mail::send($email);
    }
}
