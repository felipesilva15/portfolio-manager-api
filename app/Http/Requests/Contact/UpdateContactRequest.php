<?php

namespace App\Http\Requests\Contact;

use App\Enums\ContactStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
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
