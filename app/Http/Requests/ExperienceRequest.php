<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
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
            'company_name' => 'required|string|min:3|max:180',
            'position' => 'required|string|min:3|max:80',
            'locality' => 'required|string|min:2|max:120',
            'description' => 'required|string|max:4096',
            'start_date' => 'required|date',
            'end_date' => 'date|nullable',
        ];
    }
}
