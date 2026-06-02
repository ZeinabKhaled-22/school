<?php
namespace App\Repository;

use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class PromotionRepository implements PromotionRepositoryInterface
{
    // index
    public function index()
    {
        $grades = Grade::all();
        return view('students.promotions.index', compact('grades'));

    }

    // store PromotionRepository
    public function storePromotion($request)
    {

        DB::beginTransaction();

        try {

            $students = Student::where('grade_id', $request->grade_id)->where('classroom_id', $request->classroom_id)->where('section_id', $request->section_id)->where('academic_year', $request->academic_year)->get();
            if ($students->count() < 1) {
                return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }

            // update in table student
            foreach ($students as $student) {

                // $ids = explode(',', $student->id);
                // Student::whereIn('id', $ids)
                Student::whereIn('id', $students->pluck('id'))
                    ->update([
                        'grade_id' => $request->new_grade_id,
                        'classroom_id' => $request->new_classroom_id,
                        'section_id' => $request->new_section_id,
                        'academic_year' => $request->new_academic_year,
                    ]);

                // insert in to promotions
                Promotion::updateOrCreate([
                    'student_id' => $student->id,
                    'from_grade' => $request->grade_id,
                    'from_classroom' => $request->classroom_id,
                    'from_section' => $request->section_id,
                    'to_grade' => $request->new_grade_id,
                    'to_classroom' => $request->new_classroom_id,
                    'to_section' => $request->new_section_id,
                    'academic_year' => $request->academic_year,
                    'new_academic_year' => $request->new_academic_year,
                ]);

            }
            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }


    // create promotion
    public function createPromotion(){
        $promotions = Promotion::all();
        return view('students.promotions.management',compact('promotions'));
    }

    // delete all promotion
    public function deletePromotion($request){
        DB::beginTransaction();

        try {

            // التراجع عن الكل
            if($request->page_id ==1){

             $promotions = Promotion::all();
             foreach ($promotions as $promotion){

                 //التحديث في جدول الطلاب
                 $ids = explode(',',$promotion->student_id);
                 student::whereIn('id', $ids)
                 ->update([
                 'grade_id'=>$promotion->from_grade,
                 'classroom_id'=>$promotion->from_classroom,
                 'section_id'=> $promotion->from_section,
                 'academic_year'=>$promotion->academic_year,
               ]);

                 //حذف جدول الترقيات
                 Promotion::truncate();

             }
                DB::commit();
                toastr()->error(trans('message.delete'));
                return redirect()->back();

            }

            else{

                $promotion = Promotion::findorfail($request->id);
                Student::where('id', $promotion->student_id)
                    ->update([
                        'grade_id'=>$promotion->from_grade,
                        'classroom_id'=>$promotion->from_classroom,
                        'section_id'=> $promotion->from_section,
                        'academic_year'=>$promotion->academic_year,
                    ]);


                Promotion::destroy($request->id);
                DB::commit();
                toastr()->error(trans('message.delete'));
                return redirect()->back();

            }

        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }





}