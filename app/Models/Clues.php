<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clues extends Model
{
    use HasFactory;

    protected $fillable = [
      'clue'
    ];

    public function round(){
        return $this->belongsTo(Round::class, 'round_id');
    }
}
