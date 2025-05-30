<?php

namespace App\Http\Requests\Testimonial;

use App\Enums\SexEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *      schema="TestimonialRequest",
 *      required={"user_id", "name", "sex", "date", "testimonial", "status"},
 *      @OA\Property(property="user_id", type="integer", example=1, minimum=1),
 *      @OA\Property(property="name", type="string", example="Matheus", minLength=2, maxLength=120),
 *      @OA\Property(property="sex", ref="#/components/schemas/SexEnum"),
 *      @OA\Property(property="date", type="string", format="date", example="2025-04-28"),
 *      @OA\Property(property="testimonial", type="string", example="Foi um prazer trabalhar com o Felipe.", minLength=15),
 *      @OA\Property(property="original_url", type="string", format="url", example="https://www.linkedin.com/in/matheus/", maxLength=512, nullable=true)
 * )
 */
class TestimonialRequest extends FormRequest
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
            'user_id' => 'required|integer|min:1|exists:users,id',
            'name' => 'required|string|min:2|max:120',
            'sex' => ['required', Rule::enum(SexEnum::class)],
            'date' => ['required', 'date', Rule::date()->beforeOrEqual(today())],
            'testimonial' => 'required|string|min:15',
            'original_url' => 'string|max:512|url:http,https|nullable',
        ];
    }
}
