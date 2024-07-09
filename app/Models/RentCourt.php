<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RentCourt extends Model
{
    use HasFactory;

    public function practice()
    {
        return $this->belongsTo(Practice::class, 'practice_id');
    }

    public function getEndTimeAttribute()
    {
        $startTime = Carbon::createFromFormat('H:i', $this->time);
        $endTime = $startTime->copy()->addHours($this->duration);

        return $endTime->format('H:i');
    }
}
