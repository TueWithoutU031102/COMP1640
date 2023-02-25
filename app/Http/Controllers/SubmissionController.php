<?php

namespace App\Http\Controllers;

use App\Http\Requests\Submission\createSubmission;
use App\Http\Requests\Submission\updateSubmission;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subs = Submission::all();
        return view('Goodi/Submission/list', ['subs' => $subs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Goodi/Submission/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(createSubmission $request)
    {
        $authorId = Auth::user()->getAuthIdentifier();
        $submission = new Submission($request->all());
        $submission['author_id'] = $authorId;

        $startDate = new Carbon($submission['startDate']);
        $dueDate = new Carbon($submission['dueDate']);

        $days = $startDate->diffInHours($dueDate);
        $minutes = $startDate->diffInMinutes($dueDate) % 60;
        $different = (string)$days . " hours |" . (string)$minutes . " minutes";

        $isStartDateLessThanDueDate = $startDate->lt($dueDate);
        if ($isStartDateLessThanDueDate) {
            $submission->save();
            return redirect(route('indexSubmission'))
                ->with('success', 'Submission created successfully')
                ->with('$different', $different);
        }

        $submission->save();
        return redirect(route('indexSubmission'))->with('success', 'Submission created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $submission = Submission::find($id);
        return view('Goodi/Submission/show')->with('submission', $submission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Submission $submission
     * @return \Illuminate\Http\Response
     */
    public function edit(Submission $submission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(updateSubmission $request)
    {
        $input = $request->all();
        $id = $request->id;
        Submission::find($id)->update($input);
        return redirect(route("listSubmission"))->with('success', 'date updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Submission $submission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submission $submission)
    {
        //
    }

    function getDifferent($sD, $dD)
    {
        $days = $sD->diffInHours($dD);
        $minutes = $sD->diffInMinutes($dD) % 60;
        return (string)$days . " hours |" . (string)$minutes . " minutes";
    }
}
