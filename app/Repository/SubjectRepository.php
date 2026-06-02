<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectRepository implements SubjectRepositoryInterface
{
    // index
    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }


    // create
    public function create()
    {
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('subjects.create', compact('grades', 'teachers'));
    }


    // store
    public function store($request)
    {
        try {
            $subjects = new Subject();
            $subjects->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $subjects->grade_id = $request->grade_id;
            $subjects->classroom_id = $request->classroom_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('subject.create');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    // edit
    public function edit($id){
        $subject = Subject::findOrFail($id);
        $grades = Grade::all();
        $teachers = Teacher::all();
        return view('subjects.edit',compact('subject','grades','teachers'));
    }


    // update
    public function update($request){
        try {
            $subjects = Subject::findOrFail($request->id);
            $subjects->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $subjects->grade_id = $request->grade_id;
            $subjects->classroom_id = $request->classroom_id;
            $subjects->teacher_id = $request->teacher_id;
            $subjects->save();
            toastr()->success(trans('message.update'));
            return redirect()->route('subject.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }


    // delete
    public function delete($request){
        try {
            Subject::destroy($request->id);
        toastr()->error(trans('message.delete'));
        return redirect()->route('subject.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
            
        }
        
    }




}