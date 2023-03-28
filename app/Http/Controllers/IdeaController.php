<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\StoreFileRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $ideas = match ($request->sort_by) {
            'mostPopular' => Idea::withCount('likes', 'dislikes')->orderByDesc('likes_count', 'dislikes_count')->limit(5)->get(),
            'lastestIdeas' => Idea::latest()->limit(5)->get(),
            'lastestComments' => Idea::find(Comment::latest()->pluck('idea_id')),
            default => $this->ideaService->findAll()
        };


        // $sortDislike = Dislike::select(DB::raw("COUNT(idea_id) as count"), 'idea_id')
        //     ->groupBy('idea_id')
        //     ->pluck('idea_id');


        return view('Goodi/Idea/index', ['listCategories' => $categories, 'ideas' => $ideas]);
    }

    public function findIdeasByUserId()
    {
        $listIdeas = $this->ideaService->findIdeasByUserId($this->currentUser);
        dd($listIdeas);
        return view('Goodi/User/index')
            ->with('listIdeas', $listIdeas);
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
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(StoreFileRequest $request)
    {
        if ($this->ideaService->checkDueDate($request->input('dueDate'))) {
            return redirect()->back()->with('message', 'Over due!');
        }

        $authorId = Auth::user()->getAuthIdentifier();
        $idea = new Idea($request->all());
        $idea['author_id'] = $authorId;

        if ($idea->save()) {
            $ideaId = $idea->id;
            $fileController = app(FileController::class);
            $fileController->store($request, $ideaId);
            $data = [
                'from' => $this->currentUser['name'],
                'submission_id' => $idea['submission_id'],
            ];
            $this->mailService->submitIdeaNotify($data);
            return redirect(route("showSpecifiedSubmission", ['id' => $request->submission_id]))->with('message', 'Submit idea successfully');
        };
        return redirect()->back()->with('message', 'Submit idea fail!');
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

    public function download()
    {
        return view('Goodi/Idea/show');
    }
}
