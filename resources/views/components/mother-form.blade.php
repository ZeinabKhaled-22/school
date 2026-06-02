    <div class="row setup-content {{ $currentStep != 2 ? 'd-none' : '' }}" id="step-2">

    <div class="col-xs-12">
        <div class="col-md-12">

            <br>

            <div class="form-row">
                <div class="col">
                    <label>{{ trans('parent-translation.name_mother') }}</label>
                    <input type="text" wire:model="mother_name" class="form-control">
                </div>

                <div class="col">
                    <label>{{ trans('parent-translation.name_mother_en') }}</label>
                    <input type="text" wire:model="mother_name_en" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3">
                    <label>{{ trans('parent-translation.job_mother') }}</label>
                    <input type="text" wire:model="mother_job" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>{{ trans('parent-translation.job_mother_en') }}</label>
                    <input type="text" wire:model="mother_job_en" class="form-control">
                </div>

                <div class="col">
                    <label>{{ trans('parent-translation.national_id_mother') }}</label>
                    <input type="text" wire:model="mother_national_id" class="form-control">
                </div>

                <div class="col">
                    <label>{{ trans('parent-translation.passport_id_mother') }}</label>
                    <input type="text" wire:model="mother_passport_id" class="form-control">
                </div>

                <div class="col">
                    <label>{{ trans('parent-translation.phone_mother') }}</label>
                    <input type="text" wire:model="mother_phone" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>{{ trans('parent-translation.nationality_mother_id') }}</label>
                    <select class="custom-select" wire:model="mother_nationality">
                        <option value="">{{ trans('parent-translation.choose') }}</option>
                        @foreach($nationalities as $national)
                            <option value="{{ $national->id }}">{{ $national->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col">
                    <label>{{ trans('parent-translation.blood_type_mother_id') }}</label>
                    <select class="custom-select" wire:model="mother_blood">
                        <option value="">{{ trans('parent-translation.choose') }}</option>
                        @foreach($type_Bloods as $type_Blood)
                            <option value="{{ $type_Blood->id }}">{{ $type_Blood->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col">
                    <label>{{ trans('parent-translation.religion_mother_id') }}</label>
                    <select class="custom-select" wire:model="mother_religion">
                        <option value="">{{ trans('parent-translation.choose') }}</option>
                        @foreach($religions as $religion)
                            <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>{{ trans('parent-translation.address_mother') }}</label>
                <textarea class="form-control" wire:model="mother_address" rows="4"></textarea>
            </div>

            <button type="button" wire:click="back(1)" class="btn btn-danger">
                {{ trans('parent-translation.back') }}
            </button>

            @if($updateMode)
                <button type="button" wire:click="secondStepSubmit_edit" class="btn btn-success">
                    {{ trans('parent-translation.next') }}
                </button>
            @else
                <button type="button" wire:click="secondStepSubmit" class="btn btn-success">
                    {{ trans('parent-translation.next') }}
                </button>
            @endif

        </div>
    </div>

</div>
