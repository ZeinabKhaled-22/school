<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quizz extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $translatable = ['name'];

    protected $guarded = [];

    protected $table = 'quizzes';

    public function teacher(){
        return $this->belongsTo(Teacher::class,'teacher_id');
    }

    public function grade(){
        return $this->belongsTo(Grade::class,'grade_id');
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }

    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }


}
