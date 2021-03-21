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

        return view('posts.showAllPosts',
        [
            //new way get the posts from model querying the database directly 
            'posts' => Post::all()->sortBy('created_at',-1,$descending = true)
        ]);
    }

    public function show_post($post_id){
        //old way
        // $post = Post::find($post_id);

        return view('posts.showPost',
        [
            'post' => Post::find($post_id)
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
}
