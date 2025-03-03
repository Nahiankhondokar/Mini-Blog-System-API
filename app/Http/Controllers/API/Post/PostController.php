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
    public function index(): JsonResponse
    {
        $posts = Post::orderByDesc('id')->get();
        $posts->load('categories', 'comments');

        return $this->sendApiResponse(PostListResource::collection($posts), 'Post list show');
    }

    public function store(PostStoreRequest $request): JsonResponse
    {
        try {
            if($request->hasFile('image')){
                $file = $request->file('image');
                $fileName = md5(rand().time()).'.'.$file->extension();
                $pathWithFile = $file->storePubliclyAs('post', $fileName, 'public');
            }
            
            $post = Post::create([
                'title'         => $request->title,
                'desciption'    => $request->desciption,
                'image'         => $pathWithFile
            ]);

            $post->categories()->attach($request->categories);
            $post->load('categories');

            return $this->sendApiResponse($post, 'Post store successfully');
        } catch (\Exception $err) {
            return $this->sendApiError($err->getMessage());
        }
    }

    public function show(string $id): JsonResponse
    {
        $post = Post::find($id);
        if(!$post){
            return $this->sendApiError('Not found!');
        }

        return $this->sendApiResponse(PostListResource::make($post), 'Single post details');
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $post               = Post::find($id);
        $post->title        = $request->title;
        $post->desciption   = $request->desciption;
        $post->save();

        $post->categories()->sync($request->categories);

        return $this->sendApiResponse($post, 'Post updated');
    }

    public function destroy(string $id): JsonResponse
    {
        $post = Post::find($id);
        if(!$post){
            return $this->sendApiError('Not found!');
        }
        $post->load('categories');
        $post->categories()->detach($post->categories);
        $post->delete();

        return $this->sendApiResponse('', 'Post deleted successfull');
    }
}
