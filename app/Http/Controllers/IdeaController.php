<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\StoreFileRequest;
use App\Models\Category;
use App\Models\Idea;
use App\Models\User;
use App\Services\IdeaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IdeaController extends Controller
{
    protected IdeaService $ideaService;
    protected User $currentUser;

    public function __construct(IdeaService $ideaService)
    {
        $this->ideaService = $ideaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $ideas = $this->ideaService->findAll();

        // $users = User::select('id', 'created_at')->get()->groupBy(function ($data) {
        //     return Carbon::parse($data->created_at)->format('M');
        // });
        $users = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('count', 'month_name');

        $labels = $users->keys();
        $data = $users->values();

        return view('Goodi/Idea/index', compact('labels', 'data'))
            ->with('listCategories', $categories)
            ->with("ideas", $ideas);
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
            $fileController = new FileController();
            $fileController->store($request, $ideaId);
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
