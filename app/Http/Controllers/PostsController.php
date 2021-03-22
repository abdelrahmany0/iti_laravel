<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostsController extends Controller
{
    public function index(){
        //old way
        // $allPosts = Post::all();
        return view('posts.index',
        [
            //new way get the posts from model querying the database directly 
            'posts' => Post::withTrashed()->orderBy('id','desc')->paginate(5)
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
        $request->validate([
            'title'         => ['required' ,'min:3' ,'unique:posts'],
            'description'   => ['required' ,'min:5']
        ]);
        $requestData = $request->all();
        // dd($requestData);
        Post::create($requestData);
        return redirect()->route('posts.index');
    }

    public function edit($post_id){
        // dd($request);
        $user_post = Post::find($post_id);
        $post_user_id = $user_post->user_id;
        return view('posts.editPost',
        [
            'post'  => Post::find($post_id),
            'user'  => User::find($post_user_id),
            'users' => User::all()
        ]);
    }

    public function update(Request $request ,$post_id){
        // dd($post_id);
        $request->validate([
            'title'         => ['required' ,'min:3' ],
            Rule::unique('posts')->ignore(Post::find($post_id)->title),
            'description'   => ['required' ,'min:5']
        ]);
        
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
