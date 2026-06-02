<?php

namespace App\Repository;

interface SubjectRepositoryInterface{
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

    // delete
    public function delete($request);

}