<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGradeRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::all();
        return view('grades.index', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGradeRequest $request)
    {
        try {
            $validated = $request->validated();
            $grade = new Grade();
            $grade->name = ['en' => $request->name_en, 'ar' => $request->name];
            $grade->note = $request->note;
            $grade->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('grade.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGradeRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            $grade = Grade::findOrFail($request->id);
            $grade->update([
                $grade->name = ['ar' => $request->name, 'en' => $request->name_en],
                $grade->note = $request->note
            ]);
            toastr()->success(trans('message.update'));
            return redirect()->route('grade.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $classroom_id = Classroom::where('grade_id', $request->id)->pluck('grade_id');
        if ($classroom_id->count() == 0) {
            $grade = Grade::findOrFail($request->id)->delete();
            toastr()->success(trans('message.delete'));
            return redirect()->route('grade.index');
        }
        else{
            toastr()->error(trans('grade-translation .delete_grade_error'));
            return redirect()->route('grade.index');
        }

    }
}
