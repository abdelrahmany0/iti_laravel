<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request ,$post_id){
        dd($request);
        $post = Post::find($post_id);
        // $user = Comment::findOrFail($request->user_id)->commentable;
        // dd($user);
        $post->comments()->create([
            'post_id'       => $post_id,
            'description'   => $request->comment,
            'user_id'       => $request->user_id,
        ]);
        return redirect()->route('posts.index');
    }
}
