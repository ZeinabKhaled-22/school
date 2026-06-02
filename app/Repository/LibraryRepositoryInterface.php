<?php
namespace App\Repository;

interface LibraryRepositoryInterface{
    // index
    public function index();

     // create
    public function create();

     // store
    public function store($request);

     // edit
    public function edit($id);

     // update
    public function update($request);

     // destroy
    public function destroy($request);

}