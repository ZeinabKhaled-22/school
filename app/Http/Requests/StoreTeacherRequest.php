<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
     public function rules()
    {
        return [
            'email' => 'required|unique:teachers,email,'.$this->id,
            'password' => 'required',
            'name_ar' => 'required',
            'name_en' => 'required',
            'specialization_id' => 'required',
            'gender_id' => 'required',
            'joining_date' => 'required|date|date_format:Y-m-d',
            'address' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'email.required' => trans('validation.required'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'name_ar.required' => trans('validation.required'),
            'name_en.required' => trans('validation.required'),
            'specialization_id.required' => trans('validation.required'),
            'gender_id.required' => trans('validation.required'),
            'joining_date.required' => trans('validation.required'),
            'address.required' => trans('validation.required'),
        ];
    }
}
