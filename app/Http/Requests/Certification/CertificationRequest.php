<?php

namespace App\Http\Requests\Certification;

use Illuminate\Foundation\Http\FormRequest;

class CertificationRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'institution_name' => 'required|string|min:3|max:180',
            'issued_date' => 'required|date',
            'expiration_date' => 'date|nullable',
            'credential_id' => 'string|min:1|max:255|nullable',
            'credential_url' => 'string||url:http,https|min:12|max:255|nullable',
        ];
    }
}
