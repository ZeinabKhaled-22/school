<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    // get classroom
    public function getClassroom($id)
    {
        return Classroom::where('grade_id', $id)->pluck('name', 'id');

    }

    // get section
    public function getSection($id)
    {
        return  Section::where('classroom_id', $id)->pluck('name', 'id');

    }

}
