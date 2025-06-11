<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *      schema="UserRequest",
 *      required={"name", "email", "password", "job_title", "phone_number", "birth_date", "locality", "about"},
 *      @OA\Property(property="name", type="string", example="Felipe Silva", minLength=3, maxLength=255),
 *      @OA\Property(property="email", type="string", format="email", example="felipe.allware@gmail.com", minLength=3, maxLength=255),
 *      @OA\Property(property="password", type="string", example="admin", minLength=3, maxLength=255),
 *      @OA\Property(property="job_title", type="string", example="Desenvolvedor fullstack", minLength=2, maxLength=40),
 *      @OA\Property(property="avatar_url", type="string", format="url", example="http://localhost:8000/images/avatar.png", maxLength=512, nullable=true),
 *      @OA\Property(property="phone_number", type="string", example="11983432682", minLength=11, maxLength=11),
 *      @OA\Property(property="birth_date", type="string", format="date", example="2003-08-15"),
 *      @OA\Property(property="locality", type="string", example="São Paulo, SP", minLength=2, maxLength=120),
 *      @OA\Property(property="about", type="string", example="<p>Olá! Eu sou o Felipe!</p>", minLength=15)
 * )
 */
class UserRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|min:3|max:255|unique:users,email,'.$this->id,
            'password' => 'required|string|min:3|max:255',
            'job_title' => 'required|string|min:2|max:40',
            'avatar_url' => 'string|url:http,https|max:512|nullable',
            'phone_number' => 'required|string|min:11|max:11',
            'birth_date' => ['required', 'date', Rule::date()->beforeOrEqual(today())],
            'locality' => 'required|string|min:2|max:120',
            'about' => 'required|string|min:15'
        ];
    }
}
