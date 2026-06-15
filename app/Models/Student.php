<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded =[];


    // relation with genders
    public function gender(){
        return $this->belongsTo(Gender::class,'gender_id');
    }


    // relation with grades
    public function grade(){
        return $this->belongsTo(Grade::class,'grade_id');
    }


    // relation with classroom
    public function classroom(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }


    // relation with section
    public function section(){
        return $this->belongsTo(Section::class,'section_id');
    }


    // relation with Image
    public function images(){
        return $this->morphMany(Image::class,'imageable');
    }

    // relation with nationality
    public function nationality(){
        return $this->belongsTo(Nationality::class,'nationality_id');
    }


    // relation with parent
    public function parent(){
        return $this->belongsTo(MyParent::class,'parent_id');
    }

    // relation with student account
    public function student_account(){
        return $this->hasMany(StudentAccount::class,'student_id');
    }

     // relation with attendance
    public function attendance(){
        return $this->hasMany(Attendance::class,'student_id');
    }

    
}
