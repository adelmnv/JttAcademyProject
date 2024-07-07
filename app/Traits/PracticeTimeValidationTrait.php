<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

trait PracticeTimeValidationTrait
{
    public function validatePracticeTime($time, $duration)
    {
        $time = Carbon::parse($time)->format('H:i');
        $startTime = Carbon::createFromTime(7, 0)->format('H:i');
        $endTime = Carbon::createFromTime(22, 0)->format('H:i');
        $closeTime = Carbon::createFromTime(23, 0)->format('H:i');

        if ($time < $startTime || $time > $endTime) {
            throw ValidationException::withMessages(['time' => 'The start time of the practice must be between 07:00 and 22:00.']);
        }

        $practiceEndTime = Carbon::parse($time)->addHours($duration);
        if ($practiceEndTime->greaterThan($closeTime) || $practiceEndTime->lessThan($startTime)) {
            throw ValidationException::withMessages(['duration' => 'The practice must end before 23:00.']);
        }

        return true;
    }

    public function validateDateTimeNotPassed($date, $time)
    {
        $currentDateTime = Carbon::now();
        $selectedDateTime = Carbon::parse($date . ' ' . $time);

        if ($selectedDateTime <= $currentDateTime) {
            throw new \Exception('That date and time have already passed.');
        }
    }
}
