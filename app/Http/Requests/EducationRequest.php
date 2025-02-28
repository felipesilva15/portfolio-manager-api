<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'institution_name' => 'required|string|min:3|max:180',
            'degree' => 'required|string|min:3|max:80',
            'locality' => 'required|string|min:2|max:120',
            'start_date' => 'required|date',
            'end_date' => 'date|nullable',
        ];
    }
}
