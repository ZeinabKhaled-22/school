<?php

namespace App\Http\Controllers;

use App\Repository\LibraryRepositoryInterface;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
     protected $Library;
    public function __construct(LibraryRepositoryInterface $Library)
    {
        $this->Library = $Library;
    }
    public function index()
    {
        return $this->Library->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Library->create();
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->Library->store($request);
        
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
        return $this->Library->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return $this->Library->edit($request);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Library->destroy($request);
    }
}
