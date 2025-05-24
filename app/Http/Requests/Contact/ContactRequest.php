<?php

namespace App\Http\Requests\Contact;

use App\Enums\ContactStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *      schema="ContactRequest",
 *      required={"name", "email", "subject", "message", "status"},
 *      @OA\Property(property="name", type="string", example="João", minLength=2, maxLength=255),
 *      @OA\Property(property="email", type="string", example="joao@email.com", minLength=3, maxLength=255),
 *      @OA\Property(property="subject", type="string", example="Oferta de emprego", minLength=3, maxLength=255),
 *      @OA\Property(property="message", type="string", example="<p>Boa tarde!</p><p>Tenho uma oferta de emprego para você</p>", minLength=4),
 *      @OA\Property(property="status", ref="#/components/schemas/ContactStatusEnum")
 * )
 */
class ContactRequest extends FormRequest
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
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|min:3|max:255',
            'subject' => 'required|string|min:3|max:255',
            'message' => 'required|string|min:4',
            'status' => ['required', Rule::enum(ContactStatus::class)],
        ];
    }
}
