<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Traits\PracticeTimeValidationTrait;
use App\Models\{GroupPractice, Membership, Type, Practice, Coach};

class GroupPracticeController extends Controller
{
    use PracticeTimeValidationTrait;

    public function view($id){
        $group = GroupPractice::find($id);
        $type = Type::find($group->practice->type_id);
        $group->type_name = $type->name;
    
        return view('group_practices.view', compact('group'));
    }

    public function edit($id){
        // $group = GroupPractice::find($id);
        // $type = Type::find($group->practice->type_id);
        // $group->type_name = $type->name;

        // $members = Membership::where('group_id',$group->id)->get();
        
        // return view('group_practices.edit', compact('group', 'members'));
    }

    public function update(Request $request, $id)
    {
        // $validated = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'phone' => ['required', 'regex:/^\+[1-9]\d{1,14}$/'],
        //     'date' => 'required|date',
        //     'time' => 'required',
        //     'duration' => 'required|integer|min:1|max:4',
        //     'court_number' => 'required|integer',
        // ]);

        // $this->validatePracticeTime($validated['time'], $validated['duration']);


        // //Проверка на то что уже существует тренировка в это время
        // //...........

        // $group = groupCourt::find($id);
        // $group->name = $validated['name'];
        // $group->phone = $validated['phone'];
        // $group->date = $validated['date'];
        // $group->time = $validated['time'];
        // $group->duration = $validated['duration'];
        // $group->court_number = $validated['court_number'];
        // $group->save();

        // return redirect()->route('memberships')->with('success', 'Изменения успешно сохранены');
    }

    public function create(){
        $coaches = Coach::all();
        $practices = Practice::whereIn('type', ['Групповые тренировки', 'Профессиональные групповые тренировки'])->get();
        $practices->transform(function ($practice) {
            $type = Type::find($practice->type_id);
            $practice->practice_type_name = $type->name;
            return $practice;
        });
        return view('group_practices.create', compact('coaches', 'practices'));
    }

    public function save(Request $request){
        $validated = $request->validate([
            'coach_id' => 'required|exists:coaches,id',
            'practice_id' => 'required|exists:practices,id',
            'days_of_week' => 'required|array|between:3,5',
            'days_of_week.*' => 'integer',
            'time' => 'required',
            'court_number' => 'required|integer',
            'capacity' => 'required|integer|min:2|max:10',
        ]);

        $this->validatePracticeTime($validated['time'], 1);

        $practice = Practice::find($validated['practice_id']);
        if ($practice) {
            if (strpos($practice->type, 'Профессиональные') != false && count($validated['days_of_week']) != 5) {
                throw ValidationException::withMessages([
                    'days_of_week' => ['5 days should be specified for professional practice.'],
                ]);
            } elseif (count($validated['days_of_week']) != 3) {
                throw ValidationException::withMessages([
                    'days_of_week' => ['3 days should be specified for group practice.'],
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                'practice_id' => ['Тренировка не найдена.'],
            ]);
        }
        
        //Проверка на то что уже существует тренировка (групповая, личная, аренда) в это время
        //...........

        $group = new GroupPractice();
        $group->practice_id = $validated['practice_id'];
        $group->coach_id = $validated['coach_id'];
        $group->days_of_week = implode(',', $validated['days_of_week']);
        $group->time = $validated['time'];
        $group->court_number = $validated['court_number'];
        $group->capacity = $validated['capacity'];
        $group->save();

        return redirect()->route('memberships')->with('success', 'Изменения успешно сохранены');
    }
}
