<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(){
        //old way
        // $allPosts = Post::all();
        return view('posts.index',
        [
            //new way get the posts from model querying the database directly 
            'posts' => Post::withTrashed()->get()->sortBy('id',-1,$descending = true)
        ]);
    }

    public function show_post($post_id){
        //old way
        // $post = Post::find($post_id); 
        return view('posts.showPost',
        [
            'post' => Post::find($post_id),
        ]);
    }

    public function create(){
        return view('posts.create',[
            'users' => User::all()
        ]);
    }

    public function store(Request $request){
        $requestData = $request->all();
        // dd($requestData);
        Post::create($requestData);
        return redirect()->route('posts.index');
    }

    public function edit($post){
        // dd($request);
        return view('posts.editPost',
        [
            'post'  => Post::find($post),
            'users' => User::all()
        ]);
    }

    public function update(Request $request ,$post_id){
        // dd($request);
        Post::where('id', $post_id)
        ->update([
            'title'         => $request['title'],
            'description'   => $request['description'],
            'user_id'       => $request['user_id'],
            ]);
            return redirect()->route('posts.index');
    }

    public function destroy($post_id){
        // dd($post_id);
        $post = Post::find($post_id);
        $post->delete();
        return redirect()->route('posts.index');
    }

    public function restore($post_id){
        // dd($post_id);
        Post::withTrashed()
        ->where('id', $post_id)
        ->restore();
        return redirect()->route('posts.index');
    }
}
