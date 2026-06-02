<?php
namespace App\Repository;

use App\Models\Fee;
use App\Models\Grade;

class FeeRepository implements FeeRepositoryInterface
{
    // index
    public function index()
    {
        $fees = Fee::all();
        $grades = Grade::all();
        return view('fees.index', compact('fees','grades'));
    }

    // create
    public function create()
    {
        $grades = Grade::all();
        return view('fees.create', compact('grades'));
    }

    // store in db
    public function store($request)
    {
        try {
            $fee = new Fee();
            $fee->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fee->amount = $request->amount;
            $fee->grade_id = $request->grade_id;
            $fee->classroom_id = $request->classroom_id;
            $fee->description = $request->description;
            $fee->fee_type = $request->fee_type;
            $fee->year = $request->year;
            $fee->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('fee.create');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            
        }

    }


    // edit
    public function edit($id){
        $fee = Fee::findOrFail($id);
        $grades = Grade::all();
        return view('fees.edit',compact('grades','fee'));
    }





    // update
    public function update($request){
        try {
            $fee = Fee::findOrFail($request->id);
            $fee->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fee->amount = $request->amount;
            $fee->description = $request->description;
            $fee->grade_id = $request->grade_id;
            $fee->classroom_id = $request->classroom_id;
            $fee->year = $request->year;
            $fee->fee_type = $request->fee_type;
            $fee->save();
            toastr()->success(trans('message.success'));
            return redirect()->route('fee.index');


        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            
        }
    }

    // destroy
    public function destroy($request){
        try {
            Fee::destroy($request->id);
            toastr()->error(trans('message.delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            
        }
        

    }

}

