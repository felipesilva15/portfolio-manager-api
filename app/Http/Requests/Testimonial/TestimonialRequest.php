<?php

namespace App\Http\Requests\Testimonial;

use App\Enums\SexEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
