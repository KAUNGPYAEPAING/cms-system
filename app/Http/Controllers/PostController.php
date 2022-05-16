<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index(){

        // $posts = auth()->user()->posts;

        $posts = Post::all();

        return view('admin.posts.index', ['posts'=>$posts]);
    }

    public function getPostImageAttribute($value)
    {
        if (strpos($value, 'https://') !== false || strpos($value, 'http://') !== false) {
            return $value;
        }
 
        return asset('storage/' . $value);
    }

    //
    public function show(Post $post){

        return view('blog-post', ['post' =>$post]);
    }

    public function create(){

        return view('admin.posts.create');
    }

    public function store(){

        $inputs = request()->validate([
            'title'=>'required| min:8| max:255',
            'post_image'=>'file',   //'mimems:jpeg,png'
            'body'=>'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');   //making directory with store('name)
        }

        auth()->user()->posts()->create($inputs);

        Session::flash('post-created-message', $inputs['title']. ' post was created');

        return redirect()->route('post.index');


    }

    public function edit(Post $post){
        return view('admin.posts.edit', ['post'=>$post]);
    }

    public function destroy(Post $post){

        

        $post -> delete();

        Session::flash('message', $post['title'].' was delete');

        return back();
    }

    public function update(Post $post){
        $inputs = request()->validate([
            'title'=>'required| min:8| max:255',
            'post_image'=>'file',   //'mimems:jpeg,png'
            'body'=>'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');   //making directory with store('name)
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);         //checking update from postpolicy, in order to do that must make policy that are connect with model// need to add model

        auth()->user()->posts()->save($post);          //can delete and write $post->save() if u don't want to save/change user  can also use update()

        Session::flash('post-update-message', $inputs['title']. ' post was updated');

        return redirect()->route('post.index');
    }
}
