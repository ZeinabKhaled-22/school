<?php
namespace App\Repository;

interface TeacherRepositoryInterface{
    // get all teacher
    public function getAllTeacher();

       //get specialization
       public function getspecialization();

       // get gender
       public function getGender();

       // store teacher
       public function storeTeacher($request);

       // edit Teacher
        public function editTeacher($id);

       // update Teacher
       public function updateTeacher($request);


       // delete Teacher
       public function deleteTeacher($request);
}