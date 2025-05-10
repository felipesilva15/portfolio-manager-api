<?php

namespace App\Http\Requests\Project;

use App\Enums\ProjectStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:120',
            'description' => 'required|string|max:4096',
            'completion_date' => 'date|nullable',
            'thumbnail_url' => 'required|url:http,https',
            'status' => ['required', Rule::enum(ProjectStatus::class)],
            'tags' => 'array',
            'tags.*.id' => 'required|integer|min:1',
            'url' => 'required|url:http,https|max:512',
            'github_url' => 'required|url:http,https|max:512',
            'project_type_id' => 'required|integer|min:1|exists:project_types,id'
        ];
    }
}
