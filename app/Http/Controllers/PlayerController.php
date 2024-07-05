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
    

    public function create(){
        return view('players.create');
    }

    public function save(Request $request){
        $validated = $request->validate([
            'fio' => 'required|min:3|max:255',
            'date_of_birth'=> 'required|date|before:today',
            'achievements' => 'required',
            'is_visible'=> 'required|min:0|max:1',
            'photo'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        $player = new Player();
        $player->fio = $validated['fio'];
        $player->achievements = $validated['achievements'];
        $player->date_of_birth = $validated['date_of_birth'];
        $player->is_visible = $validated['is_visible'];

        if ($request->hasFile('photo')) {
            try {
                $imageName = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
                
                $request->file('photo')->move(public_path('img'), $imageName);
    
                $player->main_photo_url = 'http://jttacademy_project.com/img/' . $imageName;

                $player->save();

                return redirect()->route('players');

            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => 'Error saving the file: ' . $e->getMessage()]);
            }
        }
        else{
            return redirect()->back()->withErrors(['photo' => 'Image for player is required']);
        }
    }
}