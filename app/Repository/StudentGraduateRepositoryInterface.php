<?php
namespace App\Repository;

interface StudentGraduateRepositoryInterface{
    // index
    public function index();

    // create
    public function createGraduate();

    // softdelete
    public function softDelete($request);

    // return data
    public function returnData($request);

    // delete graduate student
    public function deleteData($request);


}