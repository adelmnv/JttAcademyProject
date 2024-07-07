<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Traits\PracticeTimeValidationTrait;
use App\Models\{RentCourt, Application, Type, Practice};

class RentCourtController extends Controller
{
    use PracticeTimeValidationTrait;


    public function view($id){
        $rent = RentCourt::find($id);
    
        return view('rent_courts.view', compact('rent'));
    }

    public function edit($id){
        $rent = RentCourt::find($id);
        
        return view('rent_courts.edit', compact('rent'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^\+[1-9]\d{1,14}$/'],
            'date' => 'required|date',
            'time' => 'required',
            'duration' => 'required|integer|min:1|max:4',
            'court_number' => 'required|integer',
        ]);

        $this->validatePracticeTime($validated['time'], $validated['duration']);


        //Проверка на то что уже существует тренировка (групповая, личная, аренда) в это время
        //...........
        //Проверка на то что в это время идет турнир
        //...........

        $rent = RentCourt::find($id);
        $rent->name = $validated['name'];
        $rent->phone = $validated['phone'];
        $rent->date = $validated['date'];
        $rent->time = $validated['time'];
        $rent->duration = $validated['duration'];
        $rent->court_number = $validated['court_number'];
        $rent->save();

        return redirect()->route('admin.schedule')->with('success', 'Изменения успешно сохранены');
    }

    public function create($id = null){
        $application = null;

        if ($id !== null) {
            $application = Application::find($id);
        }

        return view('rent_courts.create', compact('application'));
    }

    public function save(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => ['required', 'regex:/^\+[1-9]\d{1,14}$/'],
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'duration' => 'required|integer|min:1|max:4',
            'court_number' => 'required|integer',
            'application_id' => 'required',
        ]);

        $this->validatePracticeTime($validated['time'], $validated['duration']);
        $this->validateDateTimeNotPassed($validated['date'], $validated['time']);

        //Проверка на то что уже существует тренировка (групповая, личная, аренда) в это время
        //...........
        //Проверка на то что в это время идет турнир
        //...........

        $rent = new RentCourt();
        $rent->name = $validated['name'];
        $rent->phone = $validated['phone'];
        $rent->date = $validated['date'];
        $rent->time = $validated['time'];
        $rent->duration = $validated['duration'];
        $rent->court_number = $validated['court_number'];
        $rent->save();

        if ($validated['application_id'] != 0) {
            $application = Application::find($validated['application_id']);
            $application->status = 4;
            $application->save();
        }

        return redirect()->route('admin.applications')->with('success', 'Изменения успешно сохранены');
    }
}
