<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeInvoice extends Model
{
    use HasFactory;

    protected $guarded =[];


    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }

    public function fee(){
        return $this->belongsTo(Fee::class,'fee_id');
    }

    public function grade(){
        return $this->belongsTo(Grade::class,'grade_id');
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }
}
