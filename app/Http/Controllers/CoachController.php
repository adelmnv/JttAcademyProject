<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coach;

class CoachController extends Controller
{
    public function coaches(){
        $coaches = Coach::where('is_visible',1)->get();
        $hidden_coaches = Coach::where('is_visible',0)->get();
        return view('coaches.coaches_page',compact('coaches', 'hidden_coaches'));
    }

    public function view($coach_id){
        $coach = Coach::findOrFail($coach_id);
        return view('coaches.view',compact('coach'));
    }

    public function edit($coach_id){
        $coach = Coach::findOrFail($coach_id);
        return view('coaches.edit',compact('coach'));
    }

    public function update(Request $request, $coach_id){
        $validated = $request->validate([
            'fio' => 'required|min:4|max:255',
            'description' => 'nullable',
            'date_of_birth'=> 'nullable',
            'experience_years'=> 'nullable', 
            'is_visible' => 'required|min:0|max:1',
            'main_photo_url'=> 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $coach = Coach::find($coach_id);
    
        $coach->fio = $validated['fio'];
        $coach->description = $validated['description'];
        $coach->date_of_birth = $validated['date_of_birth'];
        $coach->experience_years = $validated['experience_years'];
        $coach->is_visible = $validated['is_visible'];
    
        if ($request->hasFile('photo')) {
            try {
                $imageName = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
                
                $request->file('photo')->move(public_path('img'), $imageName);
    
                $coach->main_photo_url = 'http://jttacademy_project.com/img/' . $imageName;
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => 'Error saving the file: ' . $e->getMessage()]);
            }
        }
    
        $coach->save();
    
        return redirect()->route('coaches');
    }

    public function create(){
        return view('coaches.create');
    }

    public function save(Request $request){
        $validated = $request->validate([
            'fio' => 'required|min:4|max:255',
            'description' => 'required',
            'date_of_birth'=> 'required|date|before:today',
            'experience_years'=> 'required|integer', 
            'is_visible' => 'required|min:0|max:1',
            'photo'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $coach = new Coach();
        $coach->fio = $validated['fio'];
        $coach->description = $validated['description'];
        $coach->date_of_birth = $validated['date_of_birth'];
        $coach->experience_years = $validated['experience_years'];
        $coach->is_visible = $validated['is_visible'];

        if ($request->hasFile('photo')) {
            try {
                $imageName = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
                
                $request->file('photo')->move(public_path('img'), $imageName);
    
                $coach->main_photo_url = 'http://jttacademy_project.com/img/' . $imageName;

                $coach->save();

                return redirect()->route('coaches');

            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['photo' => 'Error saving the file: ' . $e->getMessage()]);
            }
        }
        else{
            return redirect()->back()->withErrors(['photo' => 'Image for player is required']);
        }
    }
}
