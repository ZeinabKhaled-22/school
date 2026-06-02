<?php

namespace App\Repository;

use App\Models\ProcessingFee;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{

    //index
    public function index(){
        $processingFees = ProcessingFee::all();
        return view('processing-fees.index',compact('processingFees'));
    }


    // store
    public function store($request){
        DB::beginTransaction();

        try {
            // حفظ البيانات في جدول معالجة الرسوم
            $processingFee = new ProcessingFee();
            $processingFee->date = date('Y-m-d');
            $processingFee->student_id = $request->student_id;
            $processingFee->amount = $request->debit;
            $processingFee->description = $request->description;
            $processingFee->save();


            // حفظ البيانات في جدول حساب الطلاب
            $students_accounts = new StudentAccount();
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'ProcessingFee';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->grade_id = $request->grade_id;
            $students_accounts->classroom_id = $request->classroom_id;
            $students_accounts->processing_id = $processingFee->id;
            $students_accounts->debit = 0.00;
            $students_accounts->credit = $request->debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();
            toastr()->success(trans('message.success'));
            return redirect()->route('processing_fee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // show
    public function show($id){
        $student = Student::findOrFail($id);
        return view('processing-fees.add',compact('student'));
    }

    // edit
    public function edit($id){
        $processingFee = ProcessingFee::findorfail($id);
        return view('processing-fees.edit',compact('processingFee'));
    }

    // update
    public function update($request){
        DB::beginTransaction();

        try {
            // تعديل البيانات في جدول معالجة الرسوم
            $processingFee = ProcessingFee::findorfail($request->id);;
            $processingFee->date = date('Y-m-d');
            $processingFee->student_id = $request->student_id;
            $processingFee->amount = $request->debit;
            $processingFee->description = $request->description;
            $processingFee->save();

            // تعديل البيانات في جدول حساب الطلاب
            $students_accounts = StudentAccount::where('processing_id',$request->id)->first();;
            $students_accounts->date = date('Y-m-d');
            $students_accounts->type = 'ProcessingFee';
            $students_accounts->student_id = $request->student_id;
            $students_accounts->processing_id = $processingFee->id;
            $students_accounts->debit = 0.00;
            $students_accounts->credit = $request->debit;
            $students_accounts->description = $request->description;
            $students_accounts->save();


            DB::commit();
            toastr()->success(trans('message.update'));
            return redirect()->route('processing_fee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // destroy
    public function destroy($request){
         try {
            ProcessingFee::destroy($request->id);
            toastr()->error(trans('message.delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}