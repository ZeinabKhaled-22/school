<?php

namespace App\Repository;

interface ReceiptStudentRepositoryInterface
{

    // index
    public function index();

    // show
    public function show($id);

    // store
    public function store($request);

    // edit
    public function edit($id);

    // update
    public function update($request);

    // destroy
    public function destroy($request);



}