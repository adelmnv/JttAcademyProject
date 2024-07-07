<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Application, Membership, Type, GroupPractice, IndividualPractice, RentCourt, Tournament};
use Carbon\Carbon;

class AdminController extends Controller
{

    public function applications(){
        $new_applications = Application::where('status',0)->OrderBy('updated_at')->get();
        $processing_applications = Application::where('status',1)->OrderBy('updated_at')->get();
        $processed_applications = Application::whereIn('status',[2,3])->OrderByDesc('updated_at')->get();
        return view('admin.applications', compact('new_applications','processing_applications', 'processed_applications'));
    }

    public function application_edit_status(Request $request, $id){
        $application = Application::findOrFail($id);

        $currentStatus = $application->status;

        if ($currentStatus === 0) {
            $application->status = 1;
        } elseif ($currentStatus === 1) {
            $processType = $request->input('processType');
            if ($processType === 'success') {
                $application->status = 2;
            } elseif ($processType === 'declined') {
                $application->status = 3;
            }
        }
        $application->save();

        return redirect()->route('admin.applications');
    }

    public function menu(){
        return view('admin.menu');
    }

    public function schedule(Request $request) {
        // Retrieve month and year from request or default to current month and year
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);
    
        // Calculate previous and next month and year for navigation
        $prevMonth = Carbon::createFromDate($year, $month)->subMonth()->month;
        $prevYear = Carbon::createFromDate($year, $month)->subMonth()->year;
        $nextMonth = Carbon::createFromDate($year, $month)->addMonth()->month;
        $nextYear = Carbon::createFromDate($year, $month)->addMonth()->year;
    
        // Determine the current month name
        $currentMonthName = Carbon::createFromDate($year, $month)->monthName;
        $currentYear = $year;
    
        // Get the start and end dates of the current month
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfWeek();
        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth()->endOfWeek();
    
        // Create an array of weekdays for the header
        $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    
        $dates = [];
        $date = $startDate->copy();
    
        while ($date->lte($endDate)) {
            $dates[] = [
                'day' => $date->format('d'),
                'date' => $date->format('Y-m-d'),
            ];
            $date->addDay();
        }
    
        // Pass data to the view
        return view('admin.schedule', compact('weekdays', 'currentMonthName', 'currentYear', 'dates', 'prevMonth', 'prevYear', 'nextMonth', 'nextYear'));
    }


    // public function dailySchedule($date) {
    //     $date = Carbon::parse($date);
    
    //     $groupPractices = GroupPractice::whereRaw("FIND_IN_SET(?, days_of_week)", [$date->dayOfWeek + 1])->orderBy('time')->get();
    //     $individualPractices = IndividualPractice::whereDate('date', $date->format('Y-m-d'))->orderBy('time')->get();
    //     $courtRents = RentCourt::whereDate('date', $date->format('Y-m-d'))->orderBy('time')->get();

    //     $tournament = Tournament::whereDate('start_date', '<=', $date->format('Y-m-d'))->whereDate('end_date', '>=', $date->format('Y-m-d'))->first();
    
    //     return view('admin.daily_schedule', compact('date', 'groupPractices', 'individualPractices', 'courtRents', 'tournament'));
    // }

    public function dailySchedule($date) {
        $date = Carbon::parse($date);
    
        $groupPractices = GroupPractice::whereRaw("FIND_IN_SET(?, days_of_week)", [$date->dayOfWeek + 1])->orderBy('time')->get()->map(function($practice) {
            $startTime = Carbon::parse($practice->time);
            $endTime = $startTime->copy()->addHours($practice->duration);
            $practice->formatted_time = $startTime->format('H:i') . ' - ' . $endTime->format('H:i');
            $practice->type = 'group';
            return $practice;
        });
    
        $individualPractices = IndividualPractice::whereDate('date', $date->format('Y-m-d'))->orderBy('time')->get()->map(function($practice) {
            $startTime = Carbon::parse($practice->time);
            $endTime = $startTime->copy()->addHours($practice->duration);
            $practice->formatted_time = $startTime->format('H:i') . ' - ' . $endTime->format('H:i');
            $practice->type = 'individual';
            return $practice;
        });
    
        $courtRents = RentCourt::whereDate('date', $date->format('Y-m-d'))->orderBy('time')->get()->map(function($rent) {
            $startTime = Carbon::parse($rent->time);
            $endTime = $startTime->copy()->addHours($rent->duration);
            $rent->formatted_time = $startTime->format('H:i') . ' - ' . $endTime->format('H:i');
            $rent->type = 'rent';
            return $rent;
        });

        $schedule = $groupPractices->merge($individualPractices)->merge($courtRents)->sortBy(function($entry) {
            return Carbon::parse(explode(' - ', $entry->formatted_time)[0]);
        });
    
        $tournament = Tournament::whereDate('start_date', '<=', $date->format('Y-m-d'))->whereDate('end_date', '>=', $date->format('Y-m-d'))->first();
    
        return view('admin.daily_schedule', compact('date', 'schedule', 'tournament'));
    }
    
    
    
    

    

}
