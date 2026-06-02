<?php
use Livewire\Component;
use App\Models\Blood;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\ParentAttachment;


new class extends Component {
    public $currentStep = 1;
    public $successMessage = '', $show_table = true, $parent_id, $updateMode = false;
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

    public $nationalities;
    public $type_Bloods;
    public $religions;
    public $parents;
    public $photos, $catchError;


    public function mount()
    {
        $this->nationalities = Nationality::all();
        $this->type_Bloods = Blood::all();
        $this->religions = Religion::all();
        $this->parents = MyParent::all();
    }


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

    // firstStepSubmit
    public function firstStepSubmit()
    {
        $this->currentStep = 2;
    }

    // secondStepSubmit
    public function secondStepSubmit()
    {

        $this->currentStep = 3;
    }


    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }

    // store in db
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

    public function submitForm_edit()
    {

        if ($this->parent_id) {
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



    public function delete($id)
    {
        MyParent::findOrFail($id)->delete();
        return redirect()->to('parent');
    }

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



    // clearForm
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



};
 ?>

<div>
    @if (!empty($successMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successMessage }}
        </div>
    @endif

    @if ($catchError)
        <div class="alert alert-danger" id="success-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $catchError }}
        </div>
    @endif


    @if($show_table)
        @include('components.parent-table')

    @else
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button"
                        class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                    <p>{{ trans('parent-translation.step1') }}</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button"
                        class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                    <p>{{ trans('parent-translation.step2') }}</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button"
                        class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                        disabled="disabled">3</a>
                    <p>{{ trans('parent-translation.step3') }}</p>
                </div>
            </div>
        </div>


        @include('components.father-form')

        @include('components.mother-form')

        <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
            @if ($currentStep != 3)
                <div style="display: none" class="row setup-content" id="step-3">
            @endif

                <div class="col-xs-12">
                    <div class="col-md-12"><br>
                        <label style="color: red">{{trans('parent-translation.attachments')}}</label>
                        <div class="form-group">
                            <input type="file" wire:model="photos" accept="image/*" multiple>
                        </div>
                        <br>

                        <input type="hidden" wire:model="parent_id">

                        <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                            wire:click="back(2)">{{ trans('parent-translation.back') }}</button>

                        @if($updateMode)
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="submitForm_edit"
                                type="button">{{trans('parent-translation.finish')}}
                            </button>
                        @else
                            <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                                type="button">{{ trans('parent-translation.finish') }}</button>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    @endif