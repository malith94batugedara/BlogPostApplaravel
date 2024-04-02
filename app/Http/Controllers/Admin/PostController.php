<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\Admin\PostFormRequest;

class PostController extends Controller
{
    public function index(){
        $posts=Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    public function create(){
        $category=Category::where('status',0)->get();
        return view('admin.posts.create',compact('category'));
    }

    public function store(PostFormRequest $request){
         $data=$request->validated();

         $post=new Post;
         $post->category_id=$data['category_id'];
         $post->name=$data['name'];
         $post->slug=Str::slug($data['slug']);
         $post->description=$data['description'];
         $post->yt_iframe=$data['yt_iframe'];
         $post->meta_title=$data['meta_title'];
         $post->meta_description=$data['meta_description'];
         $post->meta_keyword=$data['meta_keyword'];
         $post->status=$request->status == true ? 1 : 0 ;
         $post->created_by=Auth::user()->id;

         $post->save();
         return redirect(route('admin.posts'))->with('status','Post Added Successfully');
         

    }
}