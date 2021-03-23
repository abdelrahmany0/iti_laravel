<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
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

    public function show($post_id){
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

    public function store(StorePostRequest $request){
        // dd($request);

        $requestData = $request->all();
        if(isset($requestData['image'])) { 
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('/public/posts', $image_name);
            $requestData['image'] = $image_name;
        }
        Post::create($requestData);
        return redirect()->route('posts.index');
    }

    public function edit($post_id){
        // dd($request);
        return view('posts.editPost',
        [
            'post'  => Post::find($post_id),
            'users' => User::all()
        ]);
    }

    public function update(Request $request ,$post_id){
        $post = Post::find($post_id);
        dd($request);
        $request->validate([
            'title'         => ['required' ,'min:3', 'exists:posts,title','unique:posts,title,'.$post->id],
            'description'   => ['required' ,'min:5'],
            'image'         => ['image']
        ]);
        $image_name = null;
        if( $request->file('image') != null ) { 
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('/public/posts', $image_name);
        }
        Post::where('id', $post_id)
        ->update([
            'title'         => $request['title'],
            'description'   => $request['description'],
            'user_id'       => $request['user_id'],
            'image'         => $image_name ? $image_name : NULL
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
