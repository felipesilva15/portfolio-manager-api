<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="UserRequest",
 *      required={"name", "email", "password"},
 *      @OA\Property(property="name", type="string", example="Felipe Silva", minLength=3, maxLength=255),
 *      @OA\Property(property="email", type="string", format="email", example="felipe.allware@gmail.com", minLength=3, maxLength=255),
 *      @OA\Property(property="password", type="string", example="admin", minLength=3, maxLength=255)
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
            'password' => 'required|string|min:3|max:255'
        ];
    }
}
