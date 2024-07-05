<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Type,Practice,Tag, Application};

class PracticeController extends Controller
{
    public function practices(){
        $types = Type::all();
        return view('practices.practices_page',compact('types'));
    }

    public function practices_by_type($type_id){
        $selected_type = Type::findOrFail($type_id);
        $types = Type::all();
        return view('practices.by_type',compact('selected_type','types'));
    }

    public function create_application($practice_id, $type_id) {
        try {
            $practice = Practice::findOrFail($practice_id);
            $type = Type::findOrFail($type_id);
            return view('practices.create_application', compact('practice','type'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Practice or Type not found.');
        }
    }

    public function store_application(Request $request){
        $validated = $request->validate([
            'practice_id' =>'required',
            'name' => 'required|min:3|max:255',
            'phone' => ['required', 'regex:/^\+[1-9]\d{1,14}$/']
        ]);
        $application = new Application();
        $application->practice_id = $validated['practice_id'];
        $application->name = $validated['name'];
        $application->phone = $validated['phone'];
        $application->save();

        return redirect()->route('practices')->with('success', 'Заявка успешно отправлена!');
    }

    public function edit($practice_id){
        $practice = Practice::findOrFail($practice_id);
        $types = Type::all();
        return view('practices.edit',compact('practice', 'types'));
    }


    public function update(Request $request, $practice_id){
        $validated = $request->validate([
            'type_id' =>'required',
            'type' => 'required|min:4|max:255',
            'payment_type'=> 'required|min:4|max:255', 
            'description' => 'required',
            'price'=>'required',
            'is_visible'=> 'required|min:0|max:1'
        ]);
    
        $practice = Practice::find($practice_id);
    
        $practice->type_id = $validated['type_id'];
        $practice->type = $validated['type'];
        $practice->payment_type = $validated['payment_type'];
        $practice->description = $validated['description'];
        $practice->price = $validated['price'];
        $practice->is_visible = $validated['is_visible'];
    
        $practice->save();
    
        return redirect()->route('practices')->with('success', 'Тренировка обновлена успешно.');
    }

    public function create(){
        $types = Type::all();
        return view('practices.create',compact('types'));
    }

    public function save(Request $request){
        $validated = $request->validate([
            'type_id' =>'required',
            'type' => 'required|min:4|max:255',
            'payment_type'=> 'required|min:4|max:255', 
            'description' => 'required',
            'price'=>'required|integer',
            'is_visible'=> 'required|min:0|max:1'
        ]);
        $practice = new Practice();
        $practice->type_id = $validated['type_id'];
        $practice->type = $validated['type'];
        $practice->payment_type = $validated['payment_type'];
        $practice->description = $validated['description'];
        $practice->price = $validated['price'];
        $practice->is_visible = $validated['is_visible'];

        $practice->save();

        return redirect()->route('practices');
    }
}
