<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $ideas = Idea::all();
        return view('Goodi/Idea/index')
            ->with('listCategories', $categories)
            ->with("ideas", $ideas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFileRequest $request)
    {
        $authorId = Auth::user()->getAuthIdentifier();
        $idea = new Idea($request->all());
        $idea['author_id'] = $authorId;
        $idea->save();

        $ideaId = $idea->id;
        $fileController = new FileController();
        $fileController->store($request, $ideaId);
//        return redirect(route("showSpecifiedSubmission", ['id' => $request->submissionId]))->with('success', 'Submit idea successfully');
        return redirect(route("indexIdea"))->with('success', 'Submit idea successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Idea $idea
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Idea $idea
     * @return \Illuminate\Http\Response
     */
    public function edit(Idea $idea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Idea $idea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Idea $idea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Idea $idea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idea $idea)
    {
        //
    }


}
