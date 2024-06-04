<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Post,Category};

class PostController extends Controller
{
    // public function index(){

    // }

    public function view($post_id){
        $post = Post::findOrFail($post_id);
        return view('posts.view',compact('post'));
    }

    public function posts(){
        $posts = Post::where('is_visible',1)->OrderByDesc('updated_at')->get();
        $hidden_posts = Post::where('is_visible',0)->get();
        $categories = Category::all();

        return view('posts.posts_page',compact('posts','categories', 'hidden_posts'));
    }

    public function posts_by_category($category_id){
        $selected_category = Category::findOrFail($category_id);
        $visible_posts = $selected_category->posts()->where('is_visible', 1)->OrderByDesc('updated_at')->get();
        $hidden_posts = $selected_category->posts()->where('is_visible',0)->get();
        $categories = Category::all();
        return view('posts.by_category',compact('selected_category','visible_posts','categories','hidden_posts'));
    }

    public function edit($post_id){
        $post = Post::findOrFail($post_id);
        $categories = Category::all();
        return view('posts.edit',compact('post', 'categories'));
    }

    public function update(Request $request, $post_id){
        $validated = $request->validate([
            'title' => 'required|min:4|max:255',
            'category_id' =>'required',
            'description' => 'nullable',
            'is_visible'=> 'required|min:0|max:1',
            'main_photo_url'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        $post = Post::find($post_id);
    
        $post->title = $validated['title'];
        $post->category_id = $validated['category_id'];
        $post->description = $validated['description'];
        $post->is_visible = $validated['is_visible'];
    
        if ($request->hasFile('photo')) {
            try {
                $imageName = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
                
                $request->file('photo')->move(public_path('img'), $imageName);
    
                $post->main_photo_url = 'http://jttacademy_project.com/img/' . $imageName;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => 'Error saving the file: ' . $e->getMessage()]);
            }
        }
    
        $post->save();
    
        return redirect()->route('posts');
    }
    

    public function create(){
        $categories = Category::all();
        return view('posts.create',compact('categories'));
    }

    public function save(Request $request){
        $validated = $request->validate([
            'title' => 'required|min:4|max:255',
            'category_id' =>'required',
            'description' => 'required',
            'is_visible'=> 'required|min:0|max:1',
            'photo'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        $post = new Post();
        $post->title = $validated['title'];
        $post->category_id = $validated['category_id'];
        $post->description = $validated['description'];
        $post->is_visible = $validated['is_visible'];

        if ($request->hasFile('photo')) {
            try {
                $imageName = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
                
                $request->file('photo')->move(public_path('img'), $imageName);
    
                $post->main_photo_url = 'http://jttacademy_project.com/img/' . $imageName;

                $post->save();

                return redirect()->route('posts.view', ['post_id'=>$post->id]);

            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => 'Error saving the file: ' . $e->getMessage()]);
            }
        }
        else{
            return redirect()->back()->withErrors(['photo' => 'Image for post is required']);
        }

        
        //return back();
    }
}
