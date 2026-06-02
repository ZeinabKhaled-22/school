<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use Illuminate\Http\Request;
use App\Repository\TeacherRepositoryInterface;

class TeacherController extends Controller
{

protected $Teacher;
public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = $this->Teacher->getAllTeacher();
        return view('teachers.teacher',compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specializations = $this->Teacher->getspecialization();
        $genders = $this->Teacher->getGender();
        return view('teachers.create', compact('specializations', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        return $this->Teacher->storeTeacher($request);
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
    public function edit($id)
    {
        $teacher = $this->Teacher->editTeacher($id);
        $specializations = $this->Teacher->getspecialization();
        $genders = $this->Teacher->getGender();
        return view('teachers.edit', compact('teacher','specializations','genders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTeacherRequest $request)
    {
        return $this->Teacher->updateTeacher($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Teacher->deleteTeacher($request);
    }
}
