<?php

namespace App\Http\Requests\Experience;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="ExperienceRequest",
 *      required={"company_name", "position", "locality", "description", "start_date"},
 *      @OA\Property(property="company_name", type="string", example="PWI Sistemas", minLength=3, maxLength=180),
 *      @OA\Property(property="position", type="string", example="Analista desenvolvedor fullstack", minLength=3, maxLength=80),
 *      @OA\Property(property="locality", type="string", example="São Paulo, SP", minLength=2, maxLength=120),
 *      @OA\Property(property="description", type="string", example="Atuei como desenvolvedor fullstack com as tecnologias Angular, Laravel, Node e SQL.", maxLength=4096),
 *      @OA\Property(property="start_date", type="string", format="date", example="2020-09-22"),
 *      @OA\Property(property="end_date", type="string", format="date", example=null, nullable=true)
 * )
 */
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
