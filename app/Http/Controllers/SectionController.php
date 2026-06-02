<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::with(['sections'])->get();
        $list_grades = Grade::all();
        $teachers = Teacher::all();
        return view('sections.index', compact('grades', 'list_grades','teachers'));
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
    public function store(StoreSectionRequest $request)
    {
        try {
            $validated = $request->validated();
            $section = new Section();
            $section->name = ['ar' => $request->name_section_ar, 'en' => $request->name_section_en];
            $section->grade_id = $request->grade_id;
            $section->classroom_id = $request->classroom_id;
            $section->status = 1;
            $section->save();
            $section->teachers()->attach($request->teacher_id);
            toastr()->success(trans('message.success'));
            return redirect()->route('section.index');

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
    public function update(StoreSectionRequest $request)
    {
        try {
            $validated = $request->validated();
            $sections = Section::findOrFail($request->id);

            $sections->name = ['ar' => $request->name_section_ar, 'en' => $request->name_section_en];
            $sections->grade_id = $request->grade_id;
            $sections->classroom_id = $request->classroom_id;

            if (isset($request->status)) {
                $sections->status = 1;
            } else {
                $sections->status = 2;
            }


            // update pivot tABLE
            if (isset($request->teacher_id)) {
                $sections->teachers()->sync($request->teacher_id);
            } else {
                $sections->teachers()->sync(array());
            }


            $sections->save();
            toastr()->success(trans('message.update'));

            return redirect()->route('section.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Section::findOrFail($request->id)->delete();
        toastr()->error(trans('message.delete'));
        return redirect()->route('section.index');
    }

    public function getClasses($id)
    {
        $list_classes = Classroom::where('grade_id', $id)->pluck('name', 'id');
        return $list_classes;

    }
}
