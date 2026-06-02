<?php

namespace App\Http\Controllers;


use App\Repository\StudentGraduateRepositoryInterface;
use Illuminate\Http\Request;

class GraduateController extends Controller
{
    protected $Graduate;
    public function __construct(StudentGraduateRepositoryInterface $Graduate)
    {
        $this->Graduate = $Graduate;
    }
    public function index()
    {
        return $this->Graduate->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Graduate->createGraduate();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Graduate->softDelete($request);
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
    public function update(Request $request)
    {
        return $this->Graduate->returnData($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Graduate->deleteData($request);
    }
}
