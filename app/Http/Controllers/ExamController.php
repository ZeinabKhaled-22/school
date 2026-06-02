<?php

namespace App\Http\Controllers;

use App\Repository\ExamRepositoryInterface;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    protected $Exam;
    public function __construct(ExamRepositoryInterface $Exam)
    {
        $this->Exam = $Exam;
    }
    public function index()
    {
        return $this->Exam->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Exam->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Exam->store($request);
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
        return $this->Exam->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Exam->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Exam->destroy($request);
    }
}
