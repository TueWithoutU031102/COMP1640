<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

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
        return view('Goodi/Admin/submission/list', ['subs' => $subs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $submission = new Submission($request->all());
        $submission->save();
        return redirect('admin/submission/index')->with('success','submission created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $submission = Submission::find($id);
        return view('Goodi/Admin/submission/show')->with('submission',$submission);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function edit(Submission $submission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $id = $request->id;
        Submission::find($id)->update($input);
        return redirect('admin/acc')->with('success', 'account updated successfully');
    }

    /**
     * Update startDate of specified submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStartDate(Request $request)
    {
        $input = $request->all();
        $id = $request->id;
        Submission::find($id)->update($input);
        return redirect('admin/acc')->with('success', 'account updated successfully');
    }
/**
     * Update dueDate of specified submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateDate(Request $request)
    {
        $input = $request->all();
        $id = $request->id;
        Submission::find($id)->update($input);
        return redirect(route("listSubmission"))->with('success', 'account updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Submission  $submission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submission $submission)
    {
        //
    }
}
