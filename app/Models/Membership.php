<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    public function group()
    {
        return $this->belongsTo(GroupPractice::class, 'group_id');
    }
}
