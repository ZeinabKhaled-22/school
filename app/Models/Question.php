<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guraded = [];

    public function quizz(){
        return $this->belongsTo(Quizz::class,'quizz_id');
    }
}
