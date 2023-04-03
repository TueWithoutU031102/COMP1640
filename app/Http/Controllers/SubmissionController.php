<?php

namespace App\Http\Controllers;

use App\Http\Requests\Submission\createSubmission;
use App\Http\Requests\Submission\updateSubmission;
use App\Models\Category;
use App\Models\Idea;
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
        $isStartDateLessThanDueDate = $startDate->lt($dueDate);

        if ($isStartDateLessThanDueDate) {
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
    public function show($id)
    {
        $submission = $this->submissionService->findById($id);
        $message = "";
        $data = [
            'submission' => $submission,
            'timeRemaining' => '',
            'ideas' => []
        ];
        $isDue = true;
        if (!$submission) {
            $message = 'Not found!';
        } else {
            $data['timeRemaining'] = $this->submissionService->getTimeRemaining($submission->dueDate);
            $data['ideas'] = $this->ideaService->findBySubmission($submission);;
            $isDue = $submission->dueDate < now('Asia/Ho_Chi_Minh');
        }
        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            // if($sort_by=='popular')
        }

        return view('Goodi/Submission/show', $data)
            ->with('listCategories', Category::all())
            ->with('isDue', $isDue)
            ->with('message', $message);
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
    public function destroy(Submission $submission)
    {
        //
    }
}
