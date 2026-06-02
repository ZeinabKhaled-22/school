<?php
namespace App\Repository;

use App\Models\Library;

class LibraryRepository implements LibraryRepositoryInterface{
    // index
    public function index(){
        $books = Library::all();
        return view('libraries.index',compact('books'));
    }

     // create
    public function create(){}

     // store
    public function store($request){}

     // edit
    public function edit($id){}

     // update
    public function update($request){}

     // destroy
    public function destroy($request){}
}