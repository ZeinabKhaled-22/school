<?php

namespace App\Repository;

use App\Models\Exam;

class ExamRepository implements ExamRepositoryInterface
{
    // index
    public function index()
    {
        $exams = Exam::all();
        return view('exams.index', compact('exams'));
    }


    // create
    public function create()
    {
        return view('exams.create');
    }



    // store
    public function store($request)
    {
        try {
            $exams = new Exam();
            $exams->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $exams->term = $request->term;
            $exams->academic_year = $request->academic_year;

            $exams->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('exam.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }


    // edit
    public function edit($id)
    {
        $exam = Exam::findOrFail($id);
        return view('exams.edit', compact('exam'));
    }


    // update
    public function update($request)
    {
        try {
            $exam = Exam::findOrFail($request->id);
            $exam->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $exam->term = $request->term;
            $exam->academic_year = $request->academic_year;

            $exam->save();
            toastr()->success(trans('message.update'));
            return redirect()->route('exam.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }


    // destroy
    public function destroy($request){
        try {
            Exam::destroy($request->id);
             toastr()->error(trans('message.delete'));
            return redirect()->route('exam.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }




}