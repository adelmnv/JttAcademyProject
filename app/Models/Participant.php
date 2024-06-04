<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['fio', 'tournament_id', 'birth_date', 'phone', 'gender', 'status'];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
