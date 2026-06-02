<?php

namespace App\Repository;

interface AttendanceRepositoryInterface {

    // index
    public function index();

    public function show($id);

    public function store($request);

    public function edit($request);

    public function update($request);

    public function destroy($request);




}