<?php

namespace App\Http\Requests\Link;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="LinkRequest",
 *      required={"label", "url", "user_id"},
 *      @OA\Property(property="label", type="string", example="LinkedIn", minLength=2, maxLength=40),
 *      @OA\Property(property="url", type="string", format="url", example="https://www.linkedin.com/in/felipe-silva1508/", maxLength=512),
 *      @OA\Property(property="icon_name", type="string", example="pi-linkedin", minLength=2, maxLength=40, nullable=true),
 *      @OA\Property(property="user_id", type="integer", example=1, minimum=1)
 * )
 */
class LinkRequest extends FormRequest
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
            'label' => 'required|string|min:2|max:40',
            'url' => 'required|string|max:512|url:http,https',
            'icon_name' => 'string|min:2|max:40|nullable',
            'user_id' => 'required|integer|min:1|exists:users,id'
        ];
    }
}
