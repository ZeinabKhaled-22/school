<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::all();
        $grades = Grade::all();
        return view('classrooms.index', compact('classrooms', 'grades'));
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
    public function store(StoreClassroomRequest $request)
    {
        $list_classes = $request->list_classes;

        try {

            $validated = $request->validated();
            foreach ($list_classes as $list_class) {

                $classes = new Classroom();

                $classes->name = ['en' => $list_class['name_class_en'], 'ar' => $list_class['name']];

                $classes->grade_id = $list_class['grade_id'];

                $classes->save();

            }

            toastr()->success(trans('message.success'));
            return redirect()->route('classroom.index');
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
    public function update(Request $request, string $id)
    {
        try {
            $classroom = Classroom::findOrFail($request->id);
            $classroom->update([
                $classroom->name = ['en' => $request->name_en, 'ar' => $request->name],
                $classroom->grade_id = $request->grade_id
            ]);
            toastr()->success(trans('message.update'));
            return redirect()->route('classroom.index');
        } catch (\Exception $e) {
             return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $classroom = Classroom::findOrFail($request->id)->delete();
        toastr()->success(trans('message.delete'));
        return redirect()->route('classroom.index');
    }

    public function deleteAll(Request $request){
        $deleted_all_id = explode(',',$request->delete_all_id);
        Classroom::whereIn('id',$deleted_all_id)->delete();
        toastr()->error(trans('message.delete'));
        return redirect()->route('classroom.index');
    }

     public function filterSearch(Request $request)
    {
        $grades = Grade::all();
        $search = Classroom::select('*')->where('grade_id','=',$request->grade_id)->get();
        return view('classrooms.index',compact('grades'))->with('classroom',$search);

    }
}
