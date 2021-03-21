<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(){
        //old way
        // $allPosts = Post::all();

        return view('posts.showAllPosts',
        [
            //new way get the posts from model querying the database directly 
            'posts' => Post::all()
        ]);
    }

    public function show_post($post_id){
        $post = [
            'id' => $post_id, 
            'title' => 'laravel', 
            'description' => 'laravel is awesome framework', 
            'posted_by' => 'Ahmed', 
            'created_at' => '2021-03-20'];

        return view('posts.showPost',
        [
            'post' => $post
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(){
        return redirect()->route('posts.index');
    }
}
