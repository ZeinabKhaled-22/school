<?php

namespace App\Repository;

use App\Models\Fee;
use App\Models\FeeInvoice;
use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class FeeInvoiceRepository implements FeeInvoiceRepositoryInterface
{
    // index
    public function index()
    {
        $fee_invoices = FeeInvoice::all();
        $grades = Grade::all();
        return view('fee-invoices.index', compact('fee_invoices', 'grades'));
    }

    // show
    public function show($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fee::where('classroom_id', $student->classroom_id)->get();
        return view('fee-invoices.create', compact('student', 'fees'));
    }


    // store
    public function store($request)
    {
        $list_fees = $request->list_fees;

        DB::beginTransaction();

        try {

            foreach ($list_fees as $list_fee) {
                // حفظ البيانات في جدول فواتير الرسوم الدراسية
                $fee = new FeeInvoice();
                $fee->invoice_date = date('Y-m-d');
                $fee->student_id = $list_fee['student_id'];
                $fee->grade_id = $request->grade_id;
                $fee->classroom_id = $request->classroom_id;
                ;
                $fee->fee_id = $list_fee['fee_id'];
                $fee->amount = $list_fee['amount'];
                $fee->description = $list_fee['description'];
                $fee->save();

                // حفظ البيانات في جدول حسابات الطلاب
                $StudentAccount = new StudentAccount();
                $StudentAccount->date = date('Y-m-d');
                $StudentAccount->type = 'invoice';
                $StudentAccount->fee_invoice_id = $fee->id;
                $StudentAccount->grade_id = $request->grade_id;
                $StudentAccount->classroom_id = $request->classroom_id;
                $StudentAccount->student_id = $list_fee['student_id'];
                $StudentAccount->debit = $list_fee['amount'];
                $StudentAccount->credit = 0.00;
                $StudentAccount->description = $list_fee['description'];
                $StudentAccount->save();
            }

            DB::commit();

            toastr()->success(trans('message.success'));
            return redirect()->route('fee_invoice.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    // edit
    public function edit($id)
    {
        $fee_invoices = FeeInvoice::findOrFail($id);
        $fees = Fee::where('classroom_id', $fee_invoices->classroom_id)->get();
        return view('fee-invoices.edit', compact('fee_invoices', 'fees'));
    }



    // update
    public function update($request)
    {
        DB::beginTransaction();
        try {
            // تعديل البيانات في جدول فواتير الرسوم الدراسية
            $fees = FeeInvoice::findorfail($request->id);
            $fees->fee_id = $request->fee_id;
            $fees->amount = $request->amount;
            $fees->description = $request->description;
            $fees->save();

            // تعديل البيانات في جدول حسابات الطلاب
            $StudentAccount = StudentAccount::where('fee_invoice_id', $request->id)->first();
            $StudentAccount->debit = $request->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();
            DB::commit();

            toastr()->success(trans('message.update'));
            return redirect()->route('fee_invoice.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    // destroy
    public function destroy($request){
        try {
            FeeInvoice::destroy($request->id);
            toastr()->error(trans('message.delete'));
            return redirect()->back();
        }

        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }





}