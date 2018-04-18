<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Post;
use App\User;
use App\Comment;
use App\PhotoComment;
use Carbon;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use Spatie\Tags\Tag;



class PostsController extends Controller
{
    public function index()
    {
        //dd('stop'); //die dump
        //dd(Post::all());
        /*
        dd(Post::create([
            'title' => 'edups', 
            'description' => 'ouh ma goh im gay'            //associative array 3ashan key wi value
        ]));
        */
        //$ firstPost = Post::all() -> first();    //collection object mn magmou3a post wi ba3d keda hat el awel 
        //$firstPost = Post::first();              // select * from posts limit 1
        //dd($firstPost->title);
        //return Post::all();
        //$posts =Post::all();
        $posts=Post::paginate(3);
        //dd($posts);
        return view('posts.index',['posts' => $posts]);
    
    }
    public function create()
    {
        $users = User::all();
        return view('posts.create',['users' => $users]);
    
    }
    public function store(StorePostRequest $request)   ///kanet Request
    {
       /* $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);*/

       /* $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ],[
            'title.required' => 'Title is Required !!',
        ]);
        */
        $tags = explode(',', $request->tags);
        if( $request->file('photo'))
        {
          $path = $request->file('photo')->store('public');
        }
        else
          $path = "";
          
        $newPost=Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'photo' => $path
        ]);
        $newPost->attachTags($tags);
        return redirect(route('posts.index'));
    
    }
    public function show($id)
    {
        $post = Post::find($id);
        
        //dd($post);
        return view('posts.view',['post' => $post]);
    
    }
    public function edit($id)
    {
        $post = Post::find($id);
        $users = User::all();
        //dd($post);
        return view('posts.edit',['post' => $post,'users' => $users]);
    
    }
    public function update($id,UpdatePostRequest $request)    //type hinting ..mestani object
    {
        //Request $request = new Request service container dependency injection
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        if($request->photo)
        {
            Storage::delete(str_replace("/storage", "public", $post->photo));
            $path = $request->file('photo')->store('public');  
            $post->photo = $path;
        }
        $post->save();
        return redirect(route('posts.index'));
    
    }
    public function destroy($id)
    {   
        $post = Post::find($id);
        Storage::delete(str_replace("/storage", "public", $post->photo));
        Post::findOrFail($id)->delete();  
        return redirect(route('posts.index'));  
    }


}

//Carbon::now();