<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Quizz;
use App\Models\Subject;
use App\Models\Teacher;

class QuizzRepository implements QuizzRepositoryInterface{
    // index
    public function index(){
        $quizzes = Quizz::get();
        return view('quizzes.index', compact('quizzes'));
    }

    // create
    public function create(){
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('quizzes.create', $data);

    }

    // store
    public function store($request){
         try {

            $quizzes = new Quizz();
            $quizzes->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->grade_id;
            $quizzes->classroom_id = $request->classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = $request->teacher_id;
            $quizzes->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('quizz.create');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    // edit
    public function edit($id){
        $quizz = Quizz::findorFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::all();
        $data['teachers'] = Teacher::all();
        return view('quizzes.edit', $data, compact('quizz'),$data);
    }

    // update
    public function update($request){
        try {
            $quizz = Quizz::findorFail($request->id);
            $quizz->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->grade_id;
            $quizz->classroom_id = $request->classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->teacher_id = $request->teacher_id;
            $quizz->save();
            toastr()->success(trans('message.update'));
            return redirect()->route('quizz.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    // destroy
    public function destroy($request){
        try {
            Quizz::destroy($request->id);
            toastr()->error(trans('message.delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
}