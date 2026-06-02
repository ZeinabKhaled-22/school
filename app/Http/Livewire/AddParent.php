<?php

namespace App\Livewire;

use App\Models\Blood;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\ParentAttachment;
use App\Models\Religion;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;

    public $successMessage = '';

    public $catchError, $updateMode = false, $photos, $show_table = true, $parent_id;

    public $currentStep = 1, $parents;

    // Father_INPUTS
    public $email;
    public $password;
    public $father_name;
    public $father_name_en;
    public $father_national_id;
    public $father_passport_id;
    public $father_phone;
    public $father_job;
    public $father_job_en;
    public $father_nationality;
    public $father_blood;
    public $father_address;
    public $father_religion;

    // Mother_INPUTS
    public $mother_name;
    public $mother_name_en;
    public $mother_national_id;
    public $mother_passport_id;
    public $mother_phone;
    public $mother_job;
    public $mother_job_en;
    public $mother_nationality;
    public $mother_blood;
    public $mother_address;
    public $mother_religion;


    // validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required|email',
            'father_national_id' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'father_passport_id' => 'min:10|max:10',
            'father_phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'mother_national_id' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'mother_passport_id' => 'min:10|max:10',
            'mother_phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }


    public function render()
    {
        return view('livewire.add-parent', [
            'Nationalities' => Nationality::all(),
            'Type_Bloods' => Blood::all(),
            'Religions' => Religion::all(),
            'parents' => MyParent::all(),
        ]);

    }


    //firstStepSubmit
    public function firstStepSubmit()
    {
        $this->validate([
            'email' => 'required|unique:parents,email,' . $this->id,
            'password' => 'required',
            'father_name' => 'required',
            'father_name_en' => 'required',
            'father_job' => 'required',
            'father_job_en' => 'required',
            'father_national_id' => 'required|unique:parents,father_national_id,' . $this->id,
            'father_passport_id' => 'required|unique:parents,father_passport_id,' . $this->id,
            'father_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'father_nationality' => 'required',
            'father_blood' => 'required',
            'father_religion' => 'required',
            'father_address' => 'required',
        ]);

        $this->currentStep = 2;
    }

    // secondStep
    public function secondStepSubmit()
    {

        $this->validate([
            'mother_name' => 'required',
            'mother_name_en' => 'required',
            'mother_national_id' => 'required|unique:my__parents,National_ID_Mother,' . $this->id,
            'mother_passport_id' => 'required|unique:my__parents,Passport_ID_Mother,' . $this->id,
            'mother_phone' => 'required',
            'mother_job' => 'required',
            'mother_job_en' => 'required',
            'mother_nationality' => 'required',
            'mother_blood' => 'required',
            'mother_religion' => 'required',
            'mother_address' => 'required',
        ]);

        $this->currentStep = 3;
    }

    // //back
    public function back($step)
    {
        $this->currentStep = $step;
    }


    public function submitForm()
    {

        try {
            $parent = new MyParent();
            // Father_INPUTS
            $parent->email = $this->email;
            $parent->password = Hash::make($this->password);
            $parent->father_name = ['en' => $this->father_name_en, 'ar' => $this->father_name];
            $parent->father_national_id = $this->father_national_id;
            $parent->father_passport_id = $this->father_passport_id;
            $parent->father_phone = $this->father_phone;
            $parent->father_job = ['en' => $this->father_job_en, 'ar' => $this->father_job];
            $parent->father_nationality = $this->father_nationality;
            $parent->father_blood = $this->father_blood;
            $parent->father_religion = $this->father_religion;
            $parent->father_address = $this->father_address;

            // Mother_INPUTS
            $parent->mother_name = ['en' => $this->mother_name_en, 'ar' => $this->mother_name];
            $parent->mother_national_id = $this->mother_national_id;
            $parent->mother_passport_id = $this->mother_passport_id;
            $parent->mother_phone = $this->mother_phone;
            $parent->mother_job = ['en' => $this->mother_job_en, 'ar' => $this->mother_job];
            $parent->mother_nationality = $this->mother_nationality;
            $parent->mother_blood = $this->mother_blood;
            $parent->mother_religion = $this->mother_religion;
            $parent->mother_address = $this->mother_address;
            $parent->save();

            if (!empty($this->photos)) {
                foreach ($this->photos as $photo) {
                    $photo->storeAs($this->father_national_id, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => MyParent::latest()->first()->id,
                    ]);
                }
            }
            $this->successMessage = trans('message.success');
            $this->clearForm();
            $this->currentStep = 1;
        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }

    }

    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $parent = MyParent::where('id', $id)->first();
        $this->parent_id = $id;
        $this->email = $parent->email;
        $this->password = $parent->password;
        $this->father_name = $parent->getTranslation('father_name', 'ar');
        $this->father_name_en = $parent->getTranslation('father_name', 'en');
        $this->father_job = $parent->getTranslation('father_job', 'ar');
        ;
        $this->father_job_en = $parent->getTranslation('father_job', 'en');
        $this->father_national_id = $parent->father_national_id;
        $this->father_passport_id = $parent->father_passport_id;
        $this->father_phone = $parent->father_phone;
        $this->father_nationality = $parent->father_nationality;
        $this->father_blood = $parent->father_blood;
        $this->father_address = $parent->father_address;
        $this->father_religion = $parent->father_religion;

        $this->mother_name = $parent->getTranslation('mother_name', 'ar');
        $this->mother_name_en = $parent->getTranslation('mother_name', 'en');
        $this->mother_job = $parent->getTranslation('mother_job', 'ar');
        ;
        $this->mother_job_en = $parent->getTranslation('mother_job', 'en');
        $this->mother_national_id = $parent->mother_national_id;
        $this->mother_passport_id = $parent->mother_passport_id;
        $this->mother_phone = $parent->mother_phone;
        $this->mother_nationality = $parent->mother_nationality;
        $this->mother_blood = $parent->mother_blood;
        $this->mother_address = $parent->mother_address;
        $this->mother_religion = $parent->mother_religion;
    }

    //firstStepSubmit
    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;

    }

    //secondStepSubmit_edit
    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;

    }

    public function submitForm_edit(){

        if ($this->parent_id){
            $parent = MyParent::find($this->parent_id);
            $parent->update([
                'email' => $this->email,
                'password' => $this->password,
                'father_name' => $this->father_name,
                'father_name_en' => $this->father_name_en,
                'father_job' => $this->father_job,
                'father_job_en' => $this->father_job_en,
                'father_national_id' => $this->father_national_id,
                'father_passport_id' => $this->father_passport_id,
                'father_phone' => $this->father_phone,
                'father_nationality' => $this->father_nationality,
                'father_blood' => $this->father_blood,
                'father_address' => $this->father_address,
                'mother_name' => $this->mother_name,
                'mother_name_en' => $this->mother_name_en,
                'mother_job' => $this->mother_job,
                'mother_job_en' => $this->mother_job_en,
                'mother_national_id' => $this->mother_national_id,
                'mother_passport_id' => $this->mother_passport_id,
                'mother_phone' => $this->mother_phone,
                'mother_nationality' => $this->mother_nationality,
                'mother_blood' => $this->mother_blood,
                'mother_address' => $this->mother_address,
                'mother_religion' => $this->mother_religion,
            ]);
        }
        return redirect()->to('parent');
    }

     public function delete($id){
        MyParent::findOrFail($id)->delete();
        return redirect()->to('parent');
    }

    //clearForm
    public function clearForm()
    {
        $this->email = '';
        $this->password = '';
        $this->father_name = '';
        $this->father_job = '';
        $this->father_job_en = '';
        $this->father_name_en = '';
        $this->father_national_id = '';
        $this->father_passport_id = '';
        $this->father_phone = '';
        $this->father_nationality = '';
        $this->father_blood = '';
        $this->father_address = '';
        $this->father_religion = '';

        $this->mother_name = '';
        $this->mother_job = '';
        $this->mother_job_en = '';
        $this->mother_name_en = '';
        $this->mother_national_id = '';
        $this->mother_passport_id = '';
        $this->mother_phone = '';
        $this->mother_nationality = '';
        $this->mother_blood = '';
        $this->mother_address = '';
        $this->mother_religion = '';

    }

    // show form add
    public function showFormAdd()
    {
        $this->show_table = false;
    }




}