<?php

namespace App\Http\Controllers\parent\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Student;
use Illuminate\Http\Request;

class ChildrenParentController extends Controller
{
    public function index()
    {
        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('parents.dashboard.children.index', compact('students'));
    }


     public function results($id)
    {

        $student = Student::findorFail($id);

        if ($student->parent_id !== auth()->user()->id) {
            toastr()->error(trans('message.error_student_code'));
            return redirect()->route('sons.index');
        }
        $degrees = Degree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {
            toastr()->error(trans('message.error_student_result'));
            return redirect()->route('sons.index');
        }

        return view('pages.parents.degrees.index', compact('degrees'));

    }
}
