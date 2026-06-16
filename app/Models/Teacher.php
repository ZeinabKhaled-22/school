<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Teacher extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded = [];


    // specialization
    public function specializations(){
        return $this->belongsTo(Specialization::class,'specialization_id');
    }

    //$gender
    public function genders(){
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    // Section
    public function sections(){
        return $this->belongsToMany(Section::class,'teacher_section');
    }
}
