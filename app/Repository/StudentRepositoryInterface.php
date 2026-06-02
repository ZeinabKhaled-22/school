<?php
namespace App\Repository;

interface StudentRepositoryInterface{

    // get student
    public function getStudent();

    // create from
    public function createStudent();

    // get classrooms
    public function getClassroom($id);

    // get sections
    public function getSection($id);

    // store student
    public function storeStudent($request);

    // edit Student
    public function editStudent($id);

    // update Student
    public function updateStudent($request);

    // delete Student
    public function deleteStudent($request);

    // show student
    public function showStudent($id);

    // upload Image
    public function uploadAttachment($request);

    // download Image
    public function downloadAttachment($studentname, $filename);

    // delete Image
    public function deleteAttachment($request);


}