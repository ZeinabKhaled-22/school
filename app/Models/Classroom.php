<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];

    protected $fillable = [
        'name',
        'grade_id'
    ];

    public function grades(){
        return $this->belongsTo(Grade::class,'grade_id');
    }
}
