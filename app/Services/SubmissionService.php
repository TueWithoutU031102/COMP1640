<?php

namespace App\Services;

use App\Models\Submission;
use Carbon\Carbon;

class SubmissionService
{

    public function findAll()
    {
        return Submission::all();
    }
    public function findById($id)
    {
        return Submission::find($id);
    }

    function getTimeRemaining($dD)
    {
        $now = Carbon::now();
        $dD = new Carbon($dD);

        $days = $now->diffInDays($dD);
        $hours = $now->diffInHours($dD);
        $minutes = $now->diffInMinutes($dD) % 60;


        return $days . " days |" . ($hours % 24) . " hours |" . ($minutes % 60) . " minutes";
    }
}
