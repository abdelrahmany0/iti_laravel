<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request ,$post_id){
        // dd($request->user_id);
        // $comment = new Comment;
        // $comment->commentable_id = $post_id;
        // $comment->commentable_type = 'App\Models\Post';
        // $comment->user_id = $request->user_id ? $request->user_id : null;
        // $comment->description = $request->comment;
        // $comment->save();
        $post = Post::find($post_id);
        $post->comments()->create([
            'user_id'       => $request->user_id ? $request->user_id : null,
            'description'   =>$request->comment,
            ]);
        return redirect()->route('posts.index');
    }
}
