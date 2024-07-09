<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\GroupPractice;
use App\Models\IndividualPractice;
use App\Models\RentCourt;
use App\Models\Tournament;
use Carbon\Carbon;

trait PracticeTimeConflictTrait
{
    public function checkGroupPracticeTimeConflict($time, $duration, $daysOfWeek, $courtNumber, $coach_id)
    {
        $practiceStartTime = Carbon::parse($time)->format('H:i');
        $practiceEndTime = Carbon::parse($time)->addHours($duration)->format('H:i');

        $groupConflict = GroupPractice::where(function ($query) use ($courtNumber, $coach_id) {
            $query->where('court_number', $courtNumber)
                  ->orWhere('coach_id', $coach_id);
        })
        ->where(function ($query) use ($daysOfWeek) {
            foreach ($daysOfWeek as $day) {
                $query->orWhereRaw('FIND_IN_SET(?, days_of_week)', [$day]);
            }
        })
        ->get();

        foreach ($groupConflict as $practice) {
            $practiceStart = Carbon::parse($practice->time)->format('H:i');
            $practiceEnd = Carbon::parse($practice->time)->addHours($practice->duration)->format('H:i'); 
            if (
                ($practiceStartTime >= $practiceStart && $practiceStartTime < $practiceEnd) ||
                ($practiceEndTime > $practiceStart && $practiceEndTime <= $practiceEnd)
            ) {
                throw ValidationException::withMessages([
                'time' => [sprintf('There is already a group practice scheduled at this time. Existing practice (ID: %d): Start - %s, End - %s, New practice: Start - %s, End - %s',
                    $practice->id, $practiceStart, $practiceEnd, $practiceStartTime, $practiceEndTime)],
                ]);
            }
        }


        $individualConflict = IndividualPractice::where(function ($query) use ($courtNumber, $coach_id) {
            $query->where('court_number', $courtNumber)
                  ->orWhere('coach_id', $coach_id);
        })
        ->where(function ($query) use ($daysOfWeek) {
            foreach ($daysOfWeek as $day) {
                $query->orWhere(function ($query) use ($day) {
                    $query->whereRaw('DAYOFWEEK(`date`) = ?', [$day+1]);
                });
            }
        })
        ->get();

        foreach ($individualConflict as $practice) {
            $practiceStart = Carbon::parse($practice->time)->format('H:i');
            $practiceEnd = Carbon::parse($practice->time)->addHours($practice->duration)->format('H:i');
            if (
                ($practiceStartTime >= $practiceStart && $practiceStartTime < $practiceEnd) ||
                ($practiceEndTime > $practiceStart && $practiceEndTime <= $practiceEnd)
            ) {
                throw ValidationException::withMessages([
                    'time' => [sprintf('There is already an individual practice scheduled at this time. Existing practice (ID: %d): Start - %s, End - %s, New practice: Start - %s, End - %s',
                        $practice->id, $practiceStart, $practiceEnd, $practiceStartTime, $practiceEndTime)],
                ]);
            }
        }

        $courtRentalConflict = RentCourt::where('court_number', $courtNumber)
        ->where(function ($query) use ($daysOfWeek) {
            foreach ($daysOfWeek as $day) {
                $query->orWhere(function ($query) use ($day) {
                    $query->whereRaw('DAYOFWEEK(`date`) = ?', [$day+1]);
                });
            }
        })
        ->get();

        foreach ($courtRentalConflict as $practice) {
            $practiceStart = Carbon::parse($practice->time)->format('H:i');
            $practiceEnd = Carbon::parse($practice->time)->addHours($practice->duration)->format('H:i'); 
            if (
                ($practiceStartTime >= $practiceStart && $practiceStartTime < $practiceEnd) ||
                ($practiceEndTime > $practiceStart && $practiceEndTime <= $practiceEnd)
            ) {
                throw ValidationException::withMessages([
                    'time' => [sprintf('There is already a court rent scheduled at this time. Existing practice (ID: %d): Start - %s, End - %s, New practice: Start - %s, End - %s',
                        $practice->id, $practiceStart, $practiceEnd, $practiceStartTime, $practiceEndTime)],
                ]);
            }
        }
    }

    public function checkIndividualPracticeTimeConflict($time, $duration, $date, $courtNumber, $coach_id)
    {
        $practiceStartTime = Carbon::parse($time)->format('H:i');
        $practiceEndTime = Carbon::parse($time)->addHours($duration)->format('H:i');
        $weekday = Carbon::parse($date)->dayOfWeek;

        $groupConflict = GroupPractice::where(function ($query) use ($courtNumber, $coach_id) {
            $query->where('court_number', $courtNumber)
                  ->orWhere('coach_id', $coach_id);
        })
        ->where(function ($query) use ($weekday) {
            $query->orWhereRaw('FIND_IN_SET(?, days_of_week)', [$weekday]);
        })
        ->get();

        foreach ($groupConflict as $practice) {
            $practiceStart = Carbon::parse($practice->time)->format('H:i');
            $practiceEnd = Carbon::parse($practice->time)->addHours($practice->duration)->format('H:i'); 
            if (
                ($practiceStartTime >= $practiceStart && $practiceStartTime < $practiceEnd) ||
                ($practiceEndTime > $practiceStart && $practiceEndTime <= $practiceEnd)
            ) {
                throw ValidationException::withMessages([
                'time' => [sprintf('There is already a group practice scheduled at this time. Existing practice (ID: %d): Start - %s, End - %s, New practice: Start - %s, End - %s',
                    $practice->id, $practiceStart, $practiceEnd, $practiceStartTime, $practiceEndTime)],
                ]);
            }
        }



        $individualConflict = IndividualPractice::where('date', $date)
        ->where(function ($query) use ($courtNumber, $coach_id) {
            $query->where('court_number', $courtNumber)
                ->orWhere('coach_id', $coach_id);
        })
        ->get();

        foreach ($individualConflict as $practice) {
            $practiceStart = Carbon::parse($practice->time)->format('H:i');
            $practiceEnd = Carbon::parse($practice->time)->addHours($practice->duration)->format('H:i');
            if (
                ($practiceStartTime >= $practiceStart && $practiceStartTime < $practiceEnd) ||
                ($practiceEndTime > $practiceStart && $practiceEndTime <= $practiceEnd)
            ) {
                throw ValidationException::withMessages([
                    'time' => [sprintf('There is already an individual practice scheduled at this time. Existing practice: Start - %s, End - %s, New practice: Start - %s, End - %s',
                $practiceStart, $practiceEnd, $practiceStartTime, $practiceEndTime)],
                ]);
            }
        }


        $courtRentalConflict = RentCourt::where('court_number', $courtNumber)->where('date', $date)->get();

        foreach ($courtRentalConflict as $practice) {
            $practiceStart = Carbon::parse($practice->time)->format('H:i');
            $practiceEnd = Carbon::parse($practice->time)->addHours($practice->duration)->format('H:i'); 
            if (
                ($practiceStartTime >= $practiceStart && $practiceStartTime < $practiceEnd) ||
                ($practiceEndTime > $practiceStart && $practiceEndTime <= $practiceEnd)
            ) {
                throw ValidationException::withMessages([
                    'time' => [sprintf('There is already a court rent scheduled at this time. Existing practice: Start - %s, End - %s, New practice: Start - %s, End - %s',
                $practiceStart, $practiceEnd, $practiceStartTime, $practiceEndTime)],
                ]);
            }
        }
        
    }

    public function checkCourtRentTimeConflict($time, $duration, $date, $courtNumber)
    {
        $practiceStartTime = Carbon::parse($time)->format('H:i');
        $practiceEndTime = Carbon::parse($time)->addHours($duration)->format('H:i');
        $weekday = Carbon::parse($date)->dayOfWeek;

        $groupConflict = GroupPractice::where('court_number', $courtNumber)
        ->where(function ($query) use ($weekday) {
            $query->orWhereRaw('FIND_IN_SET(?, days_of_week)', [$weekday]);
        })
        ->get();

        foreach ($groupConflict as $practice) {
            $practiceStart = Carbon::parse($practice->time)->format('H:i');
            $practiceEnd = Carbon::parse($practice->time)->addHours($practice->duration)->format('H:i'); 
            if (
                ($practiceStartTime >= $practiceStart && $practiceStartTime < $practiceEnd) ||
                ($practiceEndTime > $practiceStart && $practiceEndTime <= $practiceEnd)
            ) {
                throw ValidationException::withMessages([
                'time' => [sprintf('There is already a group practice scheduled at this time. Existing practice (ID: %d): Start - %s, End - %s, New practice: Start - %s, End - %s',
                    $practice->id, $practiceStart, $practiceEnd, $practiceStartTime, $practiceEndTime)],
                ]);
            }
        }


        $individualConflict = IndividualPractice::where('date', $date)->where('court_number', $courtNumber)->get();

        foreach ($individualConflict as $practice) {
            $practiceStart = Carbon::parse($practice->time)->format('H:i');
            $practiceEnd = Carbon::parse($practice->time)->addHours($practice->duration)->format('H:i');
            if (
                ($practiceStartTime >= $practiceStart && $practiceStartTime < $practiceEnd) ||
                ($practiceEndTime > $practiceStart && $practiceEndTime <= $practiceEnd)
            ) {
                throw ValidationException::withMessages([
                    'time' => [sprintf('There is already an individual practice scheduled at this time. Existing practice: Start - %s, End - %s, New practice: Start - %s, End - %s',
                $practiceStart, $practiceEnd, $practiceStartTime, $practiceEndTime)],
                ]);
            }
        }


        $courtRentalConflict = RentCourt::where('court_number', $courtNumber)->where('date', $date)->get();

        foreach ($courtRentalConflict as $practice) {
            $practiceStart = Carbon::parse($practice->time)->format('H:i');
            $practiceEnd = Carbon::parse($practice->time)->addHours($practice->duration)->format('H:i'); 
            if (
                ($practiceStartTime >= $practiceStart && $practiceStartTime < $practiceEnd) ||
                ($practiceEndTime > $practiceStart && $practiceEndTime <= $practiceEnd)
            ) {
                throw ValidationException::withMessages([
                    'time' => [sprintf('There is already a court rent scheduled at this time. Existing practice: Start - %s, End - %s, New practice: Start - %s, End - %s',
                $practiceStart, $practiceEnd, $practiceStartTime, $practiceEndTime)],
                ]);
            }
        }
    }
}
