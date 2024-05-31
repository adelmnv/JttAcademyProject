<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;

class PlayerController extends Controller
{
    public function players(){
        $players = Player::where('is_visible',1)->get();
        $hidden_players = Player::where('is_visible',0)->get();
        return view('players.players_page',compact('players', 'hidden_players'));
    }

    public function edit($player_id){
        $player = Player::findOrFail($player_id);
        return view('players.edit',compact('player'));
    }

    public function update(Request $request, $player_id){
        $validated = $request->validate([
            'fio' => 'required|min:3|max:255',
            'date_of_birth'=> 'nullable',
            'achievements' => 'nullable',
            'is_visible'=> 'required|min:0|max:1',
            'main_photo_url'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
        $player = Player::find($player_id);
    
        $player->fio = $validated['fio'];
        $player->achievements = $validated['achievements'];
        $player->date_of_birth = $validated['date_of_birth'];
        $player->is_visible = $validated['is_visible'];
    
        if ($request->hasFile('photo')) {
            try {
                $imageName = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
                
                $request->file('photo')->move(public_path('img'), $imageName);
    
                $player->main_photo_url = 'http://jttacademy_project.com/img/' . $imageName;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => 'Error saving the file: ' . $e->getMessage()]);
            }
        }
    
        $player->save();
    
        return redirect()->route('players');
    }
    

    // public function create(){
    //     $categories = Category::all();
    //     return view('posts.create',compact('categories'));
    // }

    // public function store(Request $request){
    //     $validated = $request->validate([
    //         'title' => 'required|min:4|max:255',
    //         'category_id' =>'required',
    //         'description' => 'nullable',
    //         'views'=> 'required|min:1|max:255',
    //         'is_visible'=> 'required|min:0|max:1',
    //         'main_photo_url'=> 'required|min:4|max:255'
    //     ]);
    //     $post = new Post();
    //     $post->title = $validated['title'];
    //     $post->category_id = $validated['category_id'];
    //     $post->description = $validated['description'];
    //     $post->views = $validated['views'];
    //     $post->is_visible = $validated['is_visible'];
    //     $post->main_photo_url = $validated['main_photo_url'];
    //     $post->save();

    //     return redirect()->route('posts.edit', ['post_id'=>$post->id]);
    //     //return back();
    // }
}