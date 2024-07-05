<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'practice_id','phone','status'];

    public function practice(){
        return $this->belongsTo(Practice::class);
    }
}
