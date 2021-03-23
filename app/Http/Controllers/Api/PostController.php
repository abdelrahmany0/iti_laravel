<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        // dd('in index');
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    public function show(Post $post){
        return new PostResource($post);
    }


    public function store(Request $request){
        $request->validate([
            'title'         => ['required' ,'min:3' ,'unique:posts'],
            'description'   => ['required' ,'min:5'],
            'image'         => ['image'],
        ]);
        $post = Post::create($request->all());
        return new PostResource($post);
    }
}
