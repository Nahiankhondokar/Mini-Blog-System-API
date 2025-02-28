<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Resources\PostListResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('id')->get();
        return $this->sendApiResponse(PostListResource::collection($posts), 'Post list show');
    }

    public function store(PostStoreRequest $request): JsonResponse
    {
        $post = Post::create([
            'title'         => $request->title,
            'desciption'          => $request->desciption
        ]);

        $post->categories()->attach($request->categories);

        return $this->sendApiResponse($post->load('categories'), 'Post store successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
