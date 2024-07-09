<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Traits\PracticeTimeValidationTrait;
use App\Traits\PracticeTimeConflictTrait;
use App\Models\{IndividualPractice, Application, Type, Coach, Practice};
use Carbon\Carbon;

class IndividualPracticeController extends Controller
{
    use PracticeTimeValidationTrait;
    use PracticeTimeConflictTrait;

    public function view($id){
        $indv_practice = IndividualPractice::find($id);
        $type = Type::find($indv_practice->practice->type_id);
        $indv_practice->type_name = $type->name;
    
        return view('individual_practices.view', compact('indv_practice'));
    }

    public function edit($id){
        $indv_practice = IndividualPractice::find($id);
        $coaches = Coach::all();
        $practices = Practice::where('type','Персональные тренировки')->get();
        $practices->transform(function ($practice) {
            $type = Type::find($practice->type_id);
            $practice->practice_type_name = $type->name;
            return $practice;
        });
        
        return view('individual_practices.edit', compact('indv_practice', 'coaches', 'practices'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^\+[1-9]\d{1,14}$/'],
            'coach_id' => 'required|exists:coaches,id',
            'practice_id' => 'required|exists:practices,id',
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required|integer|min:1|max:4',
            'court_number' => 'required|integer',
        ]);

        $this->validatePracticeTime($validated['time'], $validated['duration']);
        $this->checkIndividualPracticeTimeConflict($validated['time'], $validated['duration'], $validated['date'], $validated['court_number'], $validated['coach_id']);

        $indv_practice = IndividualPractice::find($id);
        $indv_practice->name = $validated['name'];
        $indv_practice->phone = $validated['phone'];
        $indv_practice->coach_id = $validated['coach_id'];
        $indv_practice->practice_id = $validated['practice_id'];
        $indv_practice->date = $validated['date'];
        $indv_practice->time = $validated['time'];
        $indv_practice->duration = $validated['duration'];
        $indv_practice->court_number = $validated['court_number'];
        $indv_practice->save();

        return redirect()->route('admin.schedule')->with('success', 'Изменения успешно сохранены');
    }

    public function create($id = null){
        $application = null;

        if ($id !== null) {
            $application = Application::find($id);
        }

        $coaches = Coach::all();
        $practices = Practice::where('type','Персональные тренировки')->get();
        $practices->transform(function ($practice) {
            $type = Type::find($practice->type_id);
            $practice->practice_type_name = $type->name;
            return $practice;
        });
        
        return view('individual_practices.create', compact('coaches', 'application', 'practices'));
    }

    public function save(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^\+[1-9]\d{1,14}$/'],
            'coach_id' => 'required|exists:coaches,id',
            'practice_id' => 'required|exists:practices,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'duration' => 'required|integer|min:1|max:4',
            'court_number' => 'required|integer',
            'application_id' => 'required',
        ]);

        $this->validatePracticeTime($validated['time'], $validated['duration']);
        $this->validateDateTimeNotPassed($validated['date'], $validated['time']);
        $this->checkIndividualPracticeTimeConflict($validated['time'], $validated['duration'], $validated['date'], $validated['court_number'], $validated['coach_id']);

        $indv_practice = new IndividualPractice();
        $indv_practice->name = $validated['name'];
        $indv_practice->phone = $validated['phone'];
        $indv_practice->coach_id = $validated['coach_id'];
        $indv_practice->practice_id = $validated['practice_id'];
        $indv_practice->date = $validated['date'];
        $indv_practice->time = $validated['time'];
        $indv_practice->duration = $validated['duration'];
        $indv_practice->court_number = $validated['court_number'];
        $indv_practice->save();

        if ($validated['application_id'] != 0) {
            $application = Application::find($validated['application_id']);
            $application->status = 4;
            $application->save();
        }

        return redirect()->route('admin.applications')->with('success', 'Индивидульная тренировка успешно добавлена');
    }
}
