<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
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
            
            'name_section_ar' => 'required',
            'name_section_en' => 'required',
            'grade_id' => 'required',
            'classroom_id' => 'required',
           
        ];
    }

    public function messages()
    {
        return [
            'name_section_ar.required' => trans('section-translation.required_ar'),
            'name_section_en.required' => trans('section-translation.required_en'),
            'grade_id.required' => trans('section-translation.grade_id_required'),
            'classroom_id.required' => trans('section-translation.class_id_required'),
        ];
    }
}
