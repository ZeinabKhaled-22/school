   <div class="row setup-content {{ $currentStep != 1 ? 'd-none' : '' }}" id="step-1">

    <div class="col-xs-12">
        <div class="col-md-12">

            <br>

            <div class="form-row">
                <div class="col">
                    <label>{{ trans('parent-translation.email') }}</label>
                    <input type="email" wire:model="email" class="form-control">
                    @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>

                <div class="col">
                    <label>{{ trans('parent-translation.password') }}</label>
                    <input type="password" wire:model="password" class="form-control">
                    @error('password') <div class="alert alert-danger">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <label>{{ trans('parent-translation.name_father') }}</label>
                    <input type="text" wire:model="father_name" class="form-control">
                </div>

                <div class="col">
                    <label>{{ trans('parent-translation.name_father_en') }}</label>
                    <input type="text" wire:model="father_name_en" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-3">
                    <label>{{ trans('parent-translation.job_father') }}</label>
                    <input type="text" wire:model="father_job" class="form-control">
                </div>

                <div class="col-md-3">
                    <label>{{ trans('parent-translation.job_father_en') }}</label>
                    <input type="text" wire:model="father_job_en" class="form-control">
                </div>

                <div class="col">
                    <label>{{ trans('parent-translation.national_id_father') }}</label>
                    <input type="text" wire:model="father_national_id" class="form-control">
                </div>

                <div class="col">
                    <label>{{ trans('parent-translation.passport_id_father') }}</label>
                    <input type="text" wire:model="father_passport_id" class="form-control">
                </div>

                <div class="col">
                    <label>{{ trans('parent-translation.phone_father') }}</label>
                    <input type="text" wire:model="father_phone" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>{{ trans('parent-translation.nationality_father_id') }}</label>
                    <select class="custom-select" wire:model="father_nationality">
                        <option value="">{{ trans('parent-translation.choose') }}</option>
                        @foreach($nationalities as $national)
                            <option value="{{ $national->id }}">{{ $national->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col">
                    <label>{{ trans('parent-translation.blood_type_father_id') }}</label>
                    <select class="custom-select" wire:model="father_blood">
                        <option value="">{{ trans('parent-translation.choose') }}</option>
                        @foreach($type_Bloods as $type_Blood)
                            <option value="{{ $type_Blood->id }}">{{ $type_Blood->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col">
                    <label>{{ trans('parent-translation.religion_father_id') }}</label>
                    <select class="custom-select" wire:model="father_religion">
                        <option value="">{{ trans('parent-translation.choose') }}</option>
                        @foreach($religions as $religion)
                            <option value="{{ $religion->id }}">{{ $religion->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>{{ trans('parent-translation.address_father') }}</label>
                <textarea class="form-control" wire:model="father_address" rows="4"></textarea>
            </div>

            @if($updateMode)
                <button type="button" wire:click="firstStepSubmit_edit" class="btn btn-success">
                    {{ trans('parent-translation.next') }}
                </button>
            @else
                <button type="button" wire:click="firstStepSubmit" class="btn btn-success">
                    {{ trans('parent-translation.next') }}
                </button>
            @endif

        </div>
    </div>

</div>