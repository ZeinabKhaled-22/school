<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MyParent extends Model
{
    use HasFactory;
     use HasTranslations;
    public $translatable = ['father_name','father_job','mother_name','mother_job'];
    protected $table = 'parents';
    protected $fillable =[
        'email',
        'password',
        'father_name',
        'father_name_en',
        'father_national_id',
        'father_passport_id',
        'father_phone',
        'father_job',
        'father_job_en',
        'father_nationality',
        'father_blood',
        'father_religion',
        'father_address',
        'mother_name',
        'mother_name_en',
        'mother_national_id',
        'mother_passport_id',
        'mother_phone',
        'mother_job',
        'mother_job_en',
        'mother_nationality',
        'mother_blood',
        'mother_religion',
        'mother_address'
    ];
}
