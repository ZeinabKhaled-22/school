<?php
namespace App\Repository;

interface ProcessingFeeRepositoryInterface
{

    //index
    public function index();


    // store
    public function store($request);

    // show
    public function show($id);

    // edit
    public function edit($id);

    // update
    public function update($request);

    // destroy
    public function destroy($request);

}