<?php

namespace App\Http\Controllers;

use App\Repository\ReceiptStudentRepositoryInterface;
use Illuminate\Http\Request;

class ReceiptStudentController extends Controller
{
     protected $Receipt;
    public function __construct(ReceiptStudentRepositoryInterface $Receipt)
    {
        $this->Receipt = $Receipt;
    }

    public function index()
    {
        return $this->Receipt->index();
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
    public function store(Request $request)
    {
        return $this->Receipt->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Receipt->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->Receipt->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Receipt->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Receipt->destroy($request);
    }
}
