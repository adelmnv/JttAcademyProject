<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Traits\PracticeTimeValidationTrait;
use App\Traits\PracticeTimeConflictTrait;
use App\Models\{GroupPractice, Membership, Type, Practice, Coach};

class GroupPracticeController extends Controller
{
    use PracticeTimeValidationTrait;
    use PracticeTimeConflictTrait;

    public function view($id){
        $group = GroupPractice::find($id);
        $type = Type::find($group->practice->type_id);
        $group->type_name = $type->name;
    
        return view('group_practices.view', compact('group'));
    }

    public function edit($id){
        $group = GroupPractice::find($id);
        $coaches = Coach::all();
        $practices = Practice::whereIn('type', ['Групповые тренировки', 'Профессиональные групповые тренировки'])->get();
        $practices->transform(function ($practice) {
            $type = Type::find($practice->type_id);
            $practice->practice_type_name = $type->name;
            return $practice;
        });
        
        return view('group_practices.edit', compact('group', 'coaches', 'practices'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'coach_id' => 'required|exists:coaches,id',
            'practice_id' => 'required|exists:practices,id',
            'days_of_week' => 'required|array|between:3,5',
            'days_of_week.*' => 'integer',
            'time' => 'required',
            'court_number' => 'required|integer',
            'capacity' => 'required|integer|min:2|max:10',
        ]);

        $duration = 1;
        if ($validated['practice_id'] == 10 || $validated['practice_id'] == 11)
                $duration = 2;
                if(count($validated['days_of_week']) != 5) {
                    throw ValidationException::withMessages([
                        'days_of_week' => ['5 days should be specified for professional practice.'],
                    ]);
            } elseif (($validated['practice_id'] == 1 || $validated['practice_id'] == 3) && count($validated['days_of_week']) != 3) {
                throw ValidationException::withMessages([
                    'days_of_week' => ['3 days should be specified for group practice.'],
                ]);
            }

        $this->validatePracticeTime($validated['time'], $duration);

        $this->checkGroupPracticeTimeConflict($validated['time'], $duration, $validated['days_of_week'], $validated['court_number'], $validated['coach_id']);

        $group = GroupPractice::find($id);
        $group->practice_id = $validated['practice_id'];
        $group->coach_id = $validated['coach_id'];
        $group->days_of_week = implode(',', $validated['days_of_week']);
        $group->time = $validated['time'];
        $group->court_number = $validated['court_number'];
        $group->capacity = $validated['capacity'];
        $group->duration = $duration;
        $group->save();

        return redirect()->route('admin.schedule')->with('success', 'Изменения успешно сохранены');
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

        $practice = Practice::find($validated['practice_id']);
        $duration = 1;

        if ($practice->type == "Профессиональные групповые тренировки"){
            $duration = 2;
            if(count($validated['days_of_week']) != 5) {
                throw ValidationException::withMessages([
                    'days_of_week' => [sprintf('5 days should be specified for professional practice with ID %d.', $validated['practice_id'])],
                ]);
            }
        }
        elseif ($practice->type == "Групповые тренировки" && count($validated['days_of_week']) != 3) {
            throw ValidationException::withMessages([
                'days_of_week' => ['3 days should be specified for group practice.'],
            ]);
        }

        $this->validatePracticeTime($validated['time'], $duration);

        $this->checkGroupPracticeTimeConflict($validated['time'], $duration, $validated['days_of_week'], $validated['court_number'], $validated['coach_id']);

        $group = new GroupPractice();
        $group->practice_id = $validated['practice_id'];
        $group->coach_id = $validated['coach_id'];
        $group->days_of_week = implode(',', $validated['days_of_week']);
        $group->time = $validated['time'];
        $group->court_number = $validated['court_number'];
        $group->capacity = $validated['capacity'];
        $group->duration = $duration;
        $group->save();

        return redirect()->route('admin.schedule')->with('success', 'Групповая тренировка успешно добавлена');
    }
}
