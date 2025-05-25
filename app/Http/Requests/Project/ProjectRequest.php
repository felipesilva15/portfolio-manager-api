<?php

namespace App\Http\Requests\Project;

use App\Enums\ProjectStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *      schema="ProjectRequest",
 *      required={"title", "description", "thumbnail_url", "status", "url", "github_url", "project_type_id", "technologies", "tags"},
 *      @OA\Property(property="title", type="string", example="Portfólio", minLength=3, maxLength=120),
 *      @OA\Property(property="short_description", type="string", example="Um projeto de portfólio", maxLength=120),
 *      @OA\Property(property="description", type="string", example="<p>Meu portfólio desenvolvido em Laravel</p>", maxLength=4096),
 *      @OA\Property(property="completion_date", type="string", format="date", example="2025-04-28", nullable=true),
 *      @OA\Property(property="thumbnail_url", type="string", format="url", example="http://localhost:8000/images/logo.png"),
 *      @OA\Property(property="status", ref="#/components/schemas/ProjectStatusEnum"),
 *      @OA\Property(property="url", type="string", format="url", example="http://localhost:8000/api/documentation", maxLength=512),
 *      @OA\Property(property="github_url", type="string", format="url", example="https://github.com/felipesilva15/portfolio-manager-api", maxLength=512),
 *      @OA\Property(property="project_type_id", type="integer", example=1, minimum=1),
 *      @OA\Property(
 *          property="tags", 
 *          type="array",
 *          minItems=1,
 *          @OA\Items(
 *              required={"id"},
 *              @OA\Property(property="id", type="integer", example=1)
 *          )
 *      ),
 *      @OA\Property(
 *          property="technologies", 
 *          type="array",
 *          minItems=1,
 *          @OA\Items(
 *              required={"id"},
 *              @OA\Property(property="id", type="integer", example=1)
 *          )
 *      )
 * )
 */
class ProjectRequest extends FormRequest
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
            'short_description' => 'string|max:120',
            'description' => 'required|string|max:4096',
            'completion_date' => 'date|nullable',
            'thumbnail_url' => 'required|url:http,https',
            'status' => ['required', Rule::enum(ProjectStatus::class)],
            'tags' => 'array',
            'tags.*.id' => 'required|integer|min:1',
            'url' => 'required|url:http,https|max:512',
            'github_url' => 'required|url:http,https|max:512',
            'project_type_id' => 'required|integer|min:1|exists:project_types,id',
            'technologies' => 'array',
            'technologies.*.id' => 'required|integer|min:1|exists:technologies,id'
        ];
    }
}
