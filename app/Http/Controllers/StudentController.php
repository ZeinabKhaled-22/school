<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $Student;
    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Student = $Student;
    }
    public function index()
    {
        return $this->Student->getStudent();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Student->createStudent();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        return $this->Student->storeStudent($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Student->showStudent($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->Student->editStudent($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStudentRequest $request)
    {
        return $this->Student->updateStudent($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Student->deleteStudent($request);
    }

    // get classroom
    public function getClassroom($id)
    {
       return $this->Student->getClassroom($id);
    }

    // get section
    public function getSection($id)
    {
       return $this->Student->getSection($id);
    }

    // upload Image
    public function uploadAttachment(Request $request){
       return $this->Student->uploadAttachment($request);
    }

    // download Image
    public function downloadAttachment($studentname, $filename){
        return $this->Student->downloadAttachment($studentname, $filename);

    }

    // delete Image
    public function deleteAttachment(Request $request){
        return $this->Student->deleteAttachment($request);
        
    }

}
