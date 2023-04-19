<?php

namespace App\Http\Controllers;

use App\Http\Requests\File\StoreFileRequest;
use App\Models\Idea;
use App\Models\User;
use App\Services\CommentService;
use App\Services\EmailService;
use App\Services\IdeaService;
use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    protected UserService $userService;
    protected IdeaService $ideaService;
    protected EmailService $mailService;
    protected CommentService $commentService;


    protected User $currentUser;

    public function __construct(
        UserService    $userService,
        EmailService   $mailService,
        IdeaService    $ideaService,
        CommentService $commentService
    )
    {
        $this->userService = $userService;
        $this->ideaService = $ideaService;
        $this->mailService = $mailService;
        $this->commentService = $commentService;

        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->currentUser = Auth::user();
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */

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
        $this->validate($request, [
            'checkbox' => ['required'],
        ]);
        $idea = new Idea($request->except('checkbox'));
        $idea->author_id = Auth::user()->getAuthIdentifier();
        if ($idea->save()) {
            $ideaId = $idea->id;
            $fileController = new FileController();
            $fileController->store($request, $ideaId);

            $mailData = [
                'from' => $idea->user->name,
                'submission_id' => $idea->submission_id
            ];
            $this->mailService->submitIdeaNotify($mailData);
            return redirect(route("showSpecifiedSubmission", ['id' => $request->submission_id]))
                ->with('message', 'Submit ideas successfully');
        };
        return redirect()->back()->with('message', 'Submit ideas fail!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Idea $idea
     * @return
     */
    public function show($id)
    {
        $idea = $this->ideaService->findById($id);
        $idea->views += 1;
        $idea->save();
        return view('Goodi/Idea/show')
            ->with('idea', $idea);
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
    public function destroy($id)
    {
        //
        $idea = Idea::find($id);
        foreach ($idea->files as $file) {
            $file->delete();
        }
        $idea->delete();
        return redirect(route("showSpecifiedSubmission", ['id' => $idea->submission_id]));
    }

    public function downloadIdeaData(): Response
    {
        $results = Idea::withCount(['likes', 'dislikes', 'comments'])
            ->with(['category', 'submission', 'author'])
            ->get(['id', 'title', 'description', 'category_id', 'submission_id', 'author_id', 'created_at']);
        $data = $results->toArray();
        $filename = 'ideas.csv';

        // Create a new file handle and write the CSV headers
        $handle = fopen('php://temp', 'w');
        fputcsv($handle, [
            'ID', 'Title', 'Description', 'Category', 'Submission', 'Author', 'Likes', 'Dislikes', 'Comments', 'Created At'
        ]);

        foreach ($data as $row) {
            fputcsv($handle, [
                $row['id'], $row['title'], $row['description'],
                $row['category']['title'], $row['submission']['title'], $row['author']['name'],
                $row['likes_count'], $row['dislikes_count'], $row['comments_count'], $row['created_at']
            ]);
        }
        // Reset the file pointer
        rewind($handle);

        // Create a new response with the CSV file data
        $response = new Response(stream_get_contents($handle), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '";',
        ]);
        fclose($handle);

        return $response;
    }
}
