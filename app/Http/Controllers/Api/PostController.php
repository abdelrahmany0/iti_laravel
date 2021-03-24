<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        // dd('in index');
        $posts = Post::withTrashed()->get();
        return PostResource::collection($posts);
    }

    public function show(Post $post){
        return new PostResource($post);
    }

    public function store(StorePostRequest $request){
        $post = Post::create($request->all());
        return new PostResource($post);
    }
}
