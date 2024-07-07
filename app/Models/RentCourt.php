<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentCourt extends Model
{
    use HasFactory;

    public function practice()
    {
        return $this->belongsTo(Practice::class, 'practice_id');
    }
}
