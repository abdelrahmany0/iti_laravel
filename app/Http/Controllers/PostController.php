<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function show(Post $post){
        //old way
        // $post = Post::find($post_id);
        // dd($post);
        return view('posts.showPost',
        [
            'post' => $post,
        ]);
    }

    public function create(){
        return view('posts.create',[
            'users' => User::all()
        ]);
    }

    public function store(StorePostRequest $request){
        // dd($request);
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        if( isset($request->user_id) ){
            $post->user_id = $request->user_id;
        }
        if( $request->hasFile('image') ) { 
            $img_name = $request->file('image')->getClientOriginalName();
            // if( isset($request->user_id) ){ $image_name = $post->user->id.'-'.$img_name; }
            $request->file('image')->storeAs('/public/posts',$img_name);
            $post->image = $img_name;
        }
        // dd($post);
        $post->save();
        return redirect()->route('posts.index');
    }

    public function edit($post_id){
        // dd($request);
        $image = DB::table('posts')->select('image')
        ->where('id','=',$post_id)->get();
        // dd($image);
        return view('posts.editPost',
        [
            'post'  => Post::find($post_id),
            'post_image'  => $image,
            'users' => User::all()
        ]);
    }

    public function update(UpdatePostRequest $request ,$post_id){
        // dd($request);
        $post = Post::find($post_id);
        $image_name = NULL;
        
        if( $request->hasFile('image') ) { 
            // dd('image yes');
            $image_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs(
                '/public/posts', 
                $post->user?$post->user->id:'' .'-'.$image_name);
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
