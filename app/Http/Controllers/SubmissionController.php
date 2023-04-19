<?php

namespace App\Http\Controllers;

use App\Http\Requests\Submission\createSubmission;
use App\Http\Requests\Submission\updateSubmission;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\Idea;
use App\Models\Department;
use App\Models\Submission;
use App\Services\IdeaService;
use App\Services\SubmissionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;


class SubmissionController extends Controller
{
    protected IdeaService $ideaService;
    protected SubmissionService $submissionService;

    public function __construct(IdeaService $ideaService, SubmissionService $submissionService)
    {
        $this->ideaService = $ideaService;
        $this->submissionService = $submissionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $subs = Submission::select('*')->orderByDesc('created_at')->get();
        return view('Goodi/Submission/list', ['subs' => $subs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('Goodi/Submission/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(createSubmission $request)
    {
        $authorId = Auth::user()->getAuthIdentifier();
        $submission = new Submission($request->all());
        $submission['author_id'] = $authorId;

        $timezone = 'Asia/Ho_Chi_Minh';
        $startDate = new Carbon($submission['startDate'], $timezone);
        $dueDate = new Carbon($submission['dueDate'], $timezone);
        $dueDateComment = new Carbon($submission['dueDateComment'], $timezone);

        if ($startDate->lt($dueDate) && $dueDate->lt($dueDateComment)) {
            $submission->save();
            return redirect(route('indexSubmission'))
                ->with('success', 'Submission created successfully')
                ->with('timeRemaining', $this->submissionService->getTimeRemaining($submission['dueDate']));
        }
        $submission->save();
        return redirect(route('indexSubmission'))->with('success', 'Submission created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id, Request $request)
    {
        $categories = Category::all();

        $departments = Department::all();
        //??= la neu ideas chua duoc dinh nghia thi chay vao con neu ideas co gia tri thi k chay

        $ideas ??= match ($request->sort_by) {
            'mostPopular' => Idea::withCount('likes', 'dislikes')
                ->where('submission_id', $id)
                ->orderByRaw('(likes_count + dislikes_count) DESC')
                ->limit(5)
                ->get(),
            'lastestIdeas' => Idea::where('submission_id', $id)
                ->latest()
                ->limit(5)
                ->get(),
            'lastestComments' => Idea::where('submission_id', $id)
                ->find(Comment::where('idea_id', $id)
                ->latest()
                ->pluck('idea_id')),
            'mostviewed' => Idea::where('submission_id', $id)
                ->orderByDesc('views')
                ->limit(5)
                ->get(),
            'allIdea' => $ideas = Idea::where('submission_id', $id)
                ->select()
                ->get(),
            default => null
        };
        //dd($ideas);
        if ($request->sort_by && !$ideas) {
            $department = Department::where('name', $request->sort_by)->first();

            // truoc ? la cau dieu kien if , sau : la else
            $users = $department != null ? User::where('department_id', $department->id)->get(['id'])
                : Category::where('title', $request->sort_by)->get('id');
            if ($department != null && $users != null)
                $ideas = Idea::where('submission_id', $id)->whereIn('author_id', $users->pluck('id'))->get();
            else if ($users != null)
                $ideas = Idea::where('submission_id', $id)->whereIn('category_id', $users->pluck('id'))->get();
        }
        if ($ideas == null) $ideas = Idea::where('submission_id', $id)->get();

        $submission = $this->submissionService->findById($id);
        $message = "";
        $data = [
            'submission' => $submission,
            'timeRemaining' => '',
            'ideas' => $ideas,
        ];
        $isDue = true;
        if (!$submission) {
            $message = 'Not found!';
        } else {
            $data['timeRemaining'] = $this->submissionService->getTimeRemaining($submission->dueDate);
            $data['ideas'] = $ideas;
            $isDue = $submission->dueDate < now('Asia/Ho_Chi_Minh');
        }

        return view('Goodi/Submission/show', $data)
            ->with('listCategories', Category::all())
            ->with('isDue', $isDue)
            ->with('message', $message)
            ->with('categories', $categories)
            ->with('departments', $departments);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $submissionId = $request->id;
        Submission::find($submissionId)->update($input);
        return redirect(route("showSpecifiedSubmission", ['id' => $submissionId]))->with('success', 'date updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Submission $submission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $submission = Submission::find($id);
        $submission->delete();
        return redirect(route('indexSubmission', ['id' => $submission->id]))
            ->with('success', 'delete submission successfully!!!');
    }
}
