<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayedGames extends Model
{
    use HasFactory;
    protected $fillable = [
        'correct_answer',
        'user_id',
        'clue_id',
    ];
}
