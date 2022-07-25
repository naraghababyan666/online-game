<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'right_answer'
    ];

    public function round(){
        return $this->belongsTo(Round::class);
    }

}
