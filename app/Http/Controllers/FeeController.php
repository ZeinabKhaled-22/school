<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeeRequest;
use App\Repository\FeeRepositoryInterface;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    protected $Fee;
    public function __construct(FeeRepositoryInterface $Fee)
    {
        $this->Fee = $Fee;
    }
    public function index()
    {
        return $this->Fee->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Fee->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeeRequest $request)
    {
        return $this->Fee->store($request);
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
        return $this->Fee->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreFeeRequest $request)
    {
        return $this->Fee->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Fee->destroy($request);
    }
}
