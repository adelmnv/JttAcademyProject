<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Tournament,Participant,TournamentCategory, TournamentFile};
use Carbon\Carbon;
use Illuminate\Database\QueryException; 

use Illuminate\Support\Facades\Log;

use App\Models\Rule;


class TournamentController extends Controller
{
    public function tournaments(){
        $tournaments = Tournament::orderBy('start_date')->get();
        $tournamentsByMonth = $tournaments->groupBy(function ($tournament) {
            return substr($tournament->start_date, 0, 7);
        });

        return view('tournaments.tournaments_page', compact('tournamentsByMonth'));
    }


    public function view($tournament_id){
        $tournament = Tournament::findOrFail($tournament_id);
        $participants = Participant::where('tournament_id', $tournament_id)->get();
        $files = TournamentFile::where('tournament_id', $tournament_id)->get();
        return view('tournaments.view',compact('tournament','participants','files'));
    }

    public function create_registration($tournament_id) {
        try {
            $tournament = Tournament::findOrFail($tournament_id);
            return view('tournaments.create_registration', compact('tournament'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Tournament not found.');
        }
    }

    public function store_registration(Request $request){

        $validated = $request->validate([
            'tournament_id' =>'required',
            'fio' => 'required|min:4|max:255',
            'birth_date' => 'required',
            'gender'=>'required',
            'phone' => ['required', 'regex:/^\+[1-9]\d{1,14}$/']
        ]);
    
        $tournament = Tournament::findOrFail($validated['tournament_id']);
        $category = $tournament->category;
    
        $birth_date = Carbon::createFromFormat('Y-m-d', $validated['birth_date']);
        $categoryAge = $category->age;
        $participantAge = $birth_date->diffInYears(Carbon::now());

        if (($categoryAge != 80 and ($participantAge > $categoryAge or $participantAge < $categoryAge-3)) or ($categoryAge == 80 and $participantAge < 16)) {
            return redirect()->back()->with('error', 'Участник не подходит по возрасту для данной возрастной категории турнира.');
        }

        $existingParticipant = Participant::where([
            'fio' => $validated['fio'],
            'birth_date' => $validated['birth_date'],
            'gender' => $validated['gender'],
            'tournament_id' => $validated['tournament_id']
        ])->first();
    
        if ($existingParticipant) {
            return redirect()->back()->with('error', 'Участник с такими данными уже зарегистрирован.');
        }

        $participant = new Participant();
        $participant->tournament_id = $validated['tournament_id'];
        $participant->fio = $validated['fio'];
        $participant->birth_date = $validated['birth_date'];
        $participant->gender = $validated['gender'];
        $participant->phone = $validated['phone'];
        $participant->save();
    
        return redirect()->route('tournaments.view', ['tournament_id' => $validated['tournament_id']])->with('success', 'Участник успешно зарегистрирован.');
    }

    public function edit($tournament_id){
        $tournament = Tournament::findOrFail($tournament_id);
        $files = TournamentFile::where('tournament_id', $tournament_id)->get();
        return view('tournaments.edit',compact('tournament', 'files'));
    }


    public function update(Request $request, $tournament_id){
        $validated = $request->validate([
            'name' => 'required|min:4|max:255',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'deadline' => 'required|date|before:start_date',
            'status' => 'required|numeric|min:0|max:1',
            'files.*' => 'nullable|file|max:10240',
            'selected_files.*' => 'nullable',
        ], [
            'end_date.after' => 'Дата окончания турнира должна быть позже даты начала.',
            'deadline.before' => 'Дата окончания приема заявок должна быть раньше даты начала турнира.'
        ]);

        $tournament = Tournament::find($tournament_id);
    
        $tournament->name = $validated['name'];
        $tournament->start_date = $validated['start_date'];
        $tournament->end_date = $validated['end_date'];
        $tournament->deadline = $validated['deadline'];
        $tournament->status = $validated['status'];
    
        $tournament->save();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileModel = new TournamentFile();

                $fileName = $file->getClientOriginalName();
                $file->move(public_path('files'), $fileName);

                $fileModel->tournament_id = $tournament->id;
                $fileModel->file_name = $fileName;

                $fileModel->file_path = 'http://jttacademy_project.com/files/' . $fileName;

    
                $fileModel->save();
            }
        }

        $msg = 'Успешно внесены изменения.';

        $selectedFiles = $request->input('selected_files', []);
        try {
            if (!empty($selectedFiles)) {
                TournamentFile::whereIn('id', $selectedFiles)->delete();
                $msg .= ' Выбранные файлы успешно удалены';
            } 
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Ошибка при удалении файлов: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Произошла ошибка: ' . $e->getMessage());
        }
    
        return redirect()->route('tournaments.view', ['tournament_id' => $tournament_id])->with('success', $msg);
    }

    public function create(){
        $categories = TournamentCategory::all();
        return view('tournaments.create',compact('categories'));
    }

    public function save(Request $request){
        $validated = $request->validate([
            'name' => 'required|min:4|max:255',
            'tournament_category_id' => 'required|numeric',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'deadline' => 'required|date|before:start_date',
            'status' => 'required|numeric|min:0|max:1',
            'files.*' => 'nullable|file|max:10240'
        ], [
            'end_date.after' => 'Дата окончания турнира должна быть позже даты начала.',
            'deadline.before' => 'Дата окончания приема заявок должна быть раньше даты начала турнира.'
        ]);
    
        $tournament = new Tournament();
        $tournament->name = $validated['name'];
        $tournament->tournament_category_id = $validated['tournament_category_id'];
        $tournament->start_date = $validated['start_date'];
        $tournament->end_date = $validated['end_date'];
        $tournament->deadline = $validated['deadline'];
        $tournament->status = $validated['status'];
    
        $tournament->save();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $fileModel = new TournamentFile();

                $fileName = $file->getClientOriginalName();
                $file->move(public_path('files'), $fileName);

                $fileModel->tournament_id = $tournament->id;
                $fileModel->file_name = $fileName;

                $fileModel->file_path = 'http://jttacademy_project.com/files/' . $fileName;

    
                $fileModel->save();
            }
        }

        $msg = 'Успешно добавлен турнир.';

        return redirect()->route('tournaments.view', ['tournament_id' => $tournament->id])->with('success', $msg);
    }
}
