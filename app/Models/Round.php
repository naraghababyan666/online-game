<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    use HasFactory;


    public function clues(){
        return $this->hasMany(Clues::class);
    }

    public function answers(){
        return $this->hasOne(Answers::class, 'round_id');
    }
}
