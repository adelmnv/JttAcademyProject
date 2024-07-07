<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualPractice extends Model
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
}
