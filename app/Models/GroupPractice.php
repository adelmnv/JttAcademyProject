<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class GroupPractice extends Model
{
    use HasFactory;

    public function coach()
    {
        return $this->belongsTo(Coach::class, 'coach_id');
    }

    public function practice()
    {
        return $this->belongsTo(Practice::class, 'practice_id');
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class, 'group_id');
    }



    public function getDaysAsNamesAttribute()
    {
        $daysOfWeek = [
            0 => 'Воскресенье',
            1 => 'Понедельник',
            2 => 'Вторник',
            3 => 'Среда',
            4 => 'Четверг',
            5 => 'Пятница',
            6 => 'Суббота',
        ];

        $days = explode(',', $this->days_of_week);
        $daysAsNames = [];

        foreach ($days as $day) {
            if (isset($daysOfWeek[$day])) {
                $daysAsNames[] = $daysOfWeek[$day];
            }
        }

        return implode(', ', $daysAsNames);
    }

    public function getEndTimeAttribute()
    {
        $startTime = Carbon::createFromFormat('H:i', $this->time);
        $endTime = $startTime->copy()->addHours($this->duration);

        return $endTime->format('H:i');
    }
}
