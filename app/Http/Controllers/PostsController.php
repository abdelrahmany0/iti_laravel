<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index(){
        $allPosts = [
            ['id' => 1, 'title' => 'laravel', 'posted_by' => 'Ahmed', 'created_at' => '2021-03-20'],
            ['id' => 2, 'title' => 'PHP', 'posted_by' => 'Mohamed', 'created_at' => '2021-04-15'],
            ['id' => 3, 'title' => 'Javascript', 'posted_by' => 'Ali', 'created_at' => '2021-06-01'],
        ];

        return view('posts.showAllPosts',[
            'posts' => $allPosts
        ]);
    }

    public function show_post($post_id){
        $post = ['id' => $post_id, 'title' => 'laravel', 'description' => 'laravel is awesome framework', 'posted_by' => 'Ahmed', 'created_at' => '2021-03-20'];

        return view('posts.showPost',[
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
