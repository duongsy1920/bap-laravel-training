<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index(){

        $posts = auth()->user()->posts()->paginate(2);
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function show($id){
        $post = Post::findOrFail($id);
        return view('blog-post', ['post' => $post]);
    }

    public function create(){
        $this->authorize('create', Post::class);
        return view('admin.posts.create');
    }

    public function store(Request $request){
        $this->authorize('create', Post::class);
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required',
        ]);
        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }
        auth()->user()->posts()->create($inputs);
        Session::flash('post-created-messages', 'Post was created successfully');
        return redirect()->route('post.index');
    }

    public function destroy($id){
        $this->authorize('delete', $post);
        Post::find($id)->delete();
        Session::flash('messages', 'Post was deleted successfully');
        return back();

    }

    public function edit(Post $post){
        $this->authorize('view', $post);
        return view('admin.posts.edit', ['post'=> $post]);
    }

    public function update(Post $post){

        $inputs = request()->validate([
            'title'=> 'required|min:8|max:255',
            'post_image'=> 'file',
            'body'=> 'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);

        $post->save();

        session()->flash('post-updated-message', 'Post with title was updated '. $inputs['title']);

        return redirect()->route('post.index');
    }
}
