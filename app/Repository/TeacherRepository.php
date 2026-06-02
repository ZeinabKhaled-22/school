<?php
namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Hash;


class TeacherRepository implements TeacherRepositoryInterface
{
    // get all teacher
    public function getAllTeacher()
    {
        return Teacher::all();

    }

    // get specialization
    public function getspecialization()
    {
        return specialization::all();
    }
    // get gender
    public function getGender()
    {
        return Gender::all();
    }

    // store teacher
    public function storeTeacher($request)
    {
        try {
            $Teacher = new Teacher();
            $Teacher->email = $request->email;
            $Teacher->password = Hash::make($request->password);
            $Teacher->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $Teacher->specialization_id = $request->specialization_id;
            $Teacher->gender_id = $request->gender_id;
            $Teacher->joining_date = $request->joining_date;
            $Teacher->address = $request->address;
            $Teacher->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('teacher.create');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }


    // edit Teacher
    public function editTeacher($id)
    {
        return Teacher::findOrFail($id);
    }



    // update teacher
    public function updateTeacher($request)
    {
        try {
            $teacher = Teacher::findOrFail($request->id);
            $teacher->email = $request->email;
            $teacher->password = Hash::make($request->password);
            $teacher->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $teacher->specialization_id = $request->specialization_id;
            $teacher->gender_id = $request->gender_id;
            $teacher->joining_date = $request->joining_date;
            $teacher->address = $request->address;
            $teacher->save();
            toastr()->success(trans('message.update'));
            return redirect()->route('teacher.index');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }


    // delete Teacher
    public function deleteTeacher($request)
    {
       Teacher::findOrFail($request->id)->delete();
       toastr()->error(trans('message.delete'));
       return redirect()->route('teacher.index');
    }



}