<?php

namespace App\Http\Controllers\API\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(): JsonResponse
    {
        $comments = Comment::with('user', 'posts')->get();
        return $this->sendApiResponse(CommentResource::collection($comments), 'Comment list show');
    }

    public function store(CommentStoreRequest $request): JsonResponse
    {
        $comment = Comment::create([
            'comment'   => $request->comment,
            'user_id'   => auth()->user()->id,
            'post_id'   => $request->post_id
        ]);
        $comment->load('user', 'posts');

        return $this->sendApiResponse(CommentResource::make($comment), 'Comment store successfully');
    }
}
