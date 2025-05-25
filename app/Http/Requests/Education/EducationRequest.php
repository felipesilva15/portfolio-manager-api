<?php

namespace App\Http\Requests\Education;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="EducationRequest",
 *      required={"institution_name", "degree", "locality", "start_date"},
 *      @OA\Property(property="institution_name", type="string", example="SENAC", minLength=3, maxLength=180),
 *      @OA\Property(property="degree", type="string", example="Graduação em Sistemas para Internet", minLength=3, maxLength=80),
 *      @OA\Property(property="locality", type="string", example="São Paulo, SP", minLength=2, maxLength=120),
 *      @OA\Property(property="start_date", type="string", format="date", example="2022-02-01"),
 *      @OA\Property(property="end_date", type="string", format="date", example="2024-07-01", nullable=true)
 * )
 */
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
