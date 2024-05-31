<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(TournamentCategory::class, 'tournament_category_id');
    }

    public function files()
    {
        return $this->hasMany(TournamentFile::class);
    }
}
