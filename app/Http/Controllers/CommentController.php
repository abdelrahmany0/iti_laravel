<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request ,$post_id){
        // dd($request);
        $post = Post::find($post_id);
        $post->comments()->create([
            'description'   => $request->comment,
            'user_id'       => $request->user_id,
        ]);
        return redirect()->route('posts.index');
    }
}
