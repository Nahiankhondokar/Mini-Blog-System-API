<?php

namespace App\Http\Controllers\API\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request): JsonResponse
    {
        $comment = Comment::create([
            'comment'   => $request->comment,
            'user_id'   => auth()->user()->id
        ]);

        return $this->sendApiResponse($comment, 'Comment store successfully');
    }
}
