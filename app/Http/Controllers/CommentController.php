<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\User;
use App\Services\CommentService;
use App\Services\IdeaService;
use App\Services\EmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentController extends Controller
{
    private CommentService $commentService;
    private IdeaService $ideaService;

    public function __construct()
    {
        $this->commentService = new CommentService();
        $this->ideaService = new IdeaService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $comments = $this->commentService->findAll();
        return response()->json([
            'comments' => $comments,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Comment\StoreCommentRequest $request
     *          include idea_id & user_id(author)
     * @return JsonResponse
     */
    public function store(StoreCommentRequest $request): JsonResponse
    {
        $token = JWTAuth::parseToken()->getToken();
        $user = JWTAuth::parseToken()->authenticate();
        $user_id = $user->id;

        $comment = new Comment($request->all());
        $comment['author_id'] = $user_id;

        dd($comment);
        $this->commentService->store($comment);

        return response()->json([
            'message' => 'Comment created',
            'comment' => $comment,
            'an' => $request->get('isAnonymous'),
        ], 201);
    }

    /**
     * get comments by ideaId
     *
     * @param int $ideaId
     * @return JsonResponse list comments on specific idea
     */
    public function findCommentsByIdeaId(int $ideaId): JsonResponse
    {
        $idea = $this->ideaService->findById($ideaId);
        $comments = $idea->comments;

        return response()->json([
            'comments' => $comments,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Comment\UpdateCommentRequest $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
