<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\User;
use App\Services\CommentService;
use App\Services\IdeaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentController extends Controller
{
    protected IdeaService $ideaService;
    protected CommentService $commentService;
    protected User $currentUser;

    public function __construct(IdeaService $ideaService, CommentService $commentService)
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $this->currentUser = Auth::user();
            }
            return $next($request);
        });
        $this->commentService = $commentService;
        $this->ideaService = $ideaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json([
            'message' => 'Comment created',
        ], 200);
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
     * @param  \App\Http\Requests\Comment\StoreCommentRequest  $request
     *          include idea_id & user_id(author)
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $token = JWTAuth::parseToken()->getToken();
        $user = JWTAuth::parseToken()->authenticate();
        $user_id = $user->id;

        $comment = new Comment($request->all());
        $comment['author_id'] = $user_id;
        $this->commentService->store($comment);

        return response()->json([
            'message' => 'Comment created',
            'data' => $comment,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Comment\UpdateCommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
