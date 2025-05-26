<?php

namespace App\Http\Requests\Certification;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="CertificationRequest",
 *      required={"title", "institution_name", "issued_date"},
 *      @OA\Property(property="title", type="string", example="Docker professional", minLength=3, maxLength=255),
 *      @OA\Property(property="institution_name", type="string", example="Udemy", minLength=3, maxLength=180),
 *      @OA\Property(property="issued_date", type="string", format="date", example="2024-09-01"),
 *      @OA\Property(property="expiration_date", type="string", format="date", example=null, nullable=true),
 *      @OA\Property(property="credential_id", type="string", example="UC-2b0897e8-1567-4a09-b8e2-7a751305248a", minLength=1, maxLength=255, nullable=true),
 *      @OA\Property(property="credential_url", type="string", format="url", example="https://ude.my/UC-2b0897e8-1567-4a09-b8e2-7a751305248a", minLength=12, maxLength=255, nullable=true)
 * )
 */
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
            'credential_url' => 'string|url:http,https|min:12|max:255|nullable',
        ];
    }
}
