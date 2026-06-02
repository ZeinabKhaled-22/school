<?php
namespace App\Repository;

use App\Models\Blood;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface
{

    // get student
    public function getStudent()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }
    // create form student
    public function createStudent()
    {
        $data['grades'] = Grade::all();
        $data['classrooms'] = Classroom::all();
        $data['parents'] = MyParent::all();
        $data['genders'] = Gender::all();
        $data['nationalities'] = Nationality::all();
        $data['bloods'] = Blood::all();
        return view('students.create', $data);

    }

    // get classroom
    public function getClassroom($id)
    {
        $classroom_list = Classroom::where('grade_id', $id)->pluck('name', 'id');
        return $classroom_list;

    }

    // get section
    public function getSection($id)
    {
        $section_list = Section::where('classroom_id', $id)->pluck('name', 'id');
        return $section_list;

    }

    // store students
    public function storeStudent($request)
    {
        DB::beginTransaction();
        try {
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationality_id = $request->nationality_id;
            $students->blood_id = $request->blood_id;
            $students->date_birth = $request->date_birth;
            $students->grade_id = $request->grade_id;
            $students->classroom_id = $request->classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();

            // insert img
            if ($request->hasfile('photos')) {
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/' . $students->name, $file->getClientOriginalName(), 'upload_attachments');

                    // insert in image_table
                    $images = new Image();
                    $images->filename = $name;
                    $images->imageable_id = $students->id;
                    $images->imageable_type = 'App\Models\Student';
                    $images->save();
                }
            }
            DB::commit(); // insert data
            toastr()->success(trans('message.success'));
            return redirect()->route('student.create');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }


    // edit Student
    public function editStudent($id)
    {
        $data['grades'] = Grade::all();
        $data['genders'] = Gender::all();
        $data['parents'] = MyParent::all();
        $data['nationalities'] = Nationality::all();
        $data['bloods'] = Blood::all();
        $students = Student::findOrFail($id);
        return view('students.edit', compact('students'), $data);
    }


    // update student
    public function updateStudent($request)
    {
        try {
            $student = Student::findorfail($request->id);
            $student->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $student->email = $request->email;
            $student->password = Hash::make($request->password);
            $student->gender_id = $request->gender_id;
            $student->nationality_id = $request->nationality_id;
            $student->blood_id = $request->blood_id;
            $student->date_birth = $request->date_birth;
            $student->grade_id = $request->grade_id;
            $student->classroom_id = $request->classroom_id;
            $student->section_id = $request->section_id;
            $student->parent_id = $request->parent_id;
            $student->academic_year = $request->academic_year;
            $student->save();
            toastr()->success(trans('message.update'));
            return redirect()->route('student.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    // delete Student
    public function deleteStudent($request)
    {
        Student::destroy($request->id);
        toastr()->error(trans('message.delete'));
        return redirect()->route('student.index');
    }


    // show student
    public function showStudent($id)
    {
        $student = Student::findorfail($id);
        return view('students.show', compact('student'));
    }


    // upload Image
    public function uploadAttachment($request){
        foreach($request->file('photos') as $file)
        {
            $name = $file->getClientOriginalName();
            $file->storeAs('attachments/students/'.$request->student_name, $file->getClientOriginalName(),'upload_attachments');

            // insert in image_table
            $images= new Image();
            $images->filename=$name;
            $images->imageable_id = $request->student_id;
            $images->imageable_type = 'App\Models\Student';
            $images->save();
        }
        toastr()->success(trans('message.success'));
        return redirect()->route('student.show',$request->student_id);

    }

    // download image
    public function downloadAttachment($studentname, $filename){
        return response()->download(public_path('attachments/students/'.$studentname.'/'.$filename));
    }

    // delete image
    public function deleteAttachment($request){
        // Delete img in server disk
        Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);

        // Delete in data
        image::where('id',$request->id)->where('filename',$request->filename)->delete();
        toastr()->error(trans('message.delete'));
        return redirect()->route('student.show',$request->student_id);

    }





}