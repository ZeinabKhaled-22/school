<?php
namespace App\Repository;

use App\Models\Grade;
use App\Models\Student;

class StudentGraduateRepository implements StudentGraduateRepositoryInterface{

// index
    public function index(){
        $students = Student::onlyTrashed()->get();
        return view('students.graduates.index', compact('students'));

    }


    // create
    public function createGraduate(){
        $grades = Grade::all();
        return view('students.graduates.create',compact('grades'));
    }

    // softdelete
    public function softDelete($request){
         $students = Student::where('grade_id',$request->grade_id)->where('classroom_id',$request->classroom_id)->where('section_id',$request->section_id)->get();

        if($students->count() < 1){
            return redirect()->back()->with('error_Graduated', __('لاتوجد بيانات في جدول الطلاب'));
        }

        foreach ($students as $student){
            $ids = explode(',',$student->id);
            student::whereIn('id', $ids)->Delete();
        }

        toastr()->success(trans('message.success'));
        return redirect()->route('graduate.index');
    }



    // return data
    public function returnData($request){
        Student::withTrashed()->where('id',$request->id)->first()->restore();
        toastr()->success(trans('message.success'));
        return redirect()->back();

    }


    // delete graduate student
    public function deleteData($request){
        Student::withTrashed()->where('id',$request->id)->first()->forceDelete();
        toastr()->success(trans('message.delete'));
        return redirect()->back();

    }


}