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
        $timezone = 'Asia/Ho_Chi_Minh';
        $now = Carbon::now($timezone);
        $dD = new Carbon($dD, $timezone);


        $nowInMilliseconds = $now->valueOf();
        $dDInMilliseconds = $dD->valueOf();
        $diffMilliseconds = $dDInMilliseconds - $nowInMilliseconds;
        $days = floor( $diffMilliseconds / 86400000);
        $hours = floor( ($diffMilliseconds % 86400000) / 3600000);
        $minutes = round((($diffMilliseconds % 86400000) % 3600000) / 60000);
        return $days . " days |" . $hours . " hours |" . $minutes . " minutes";
    }
}
