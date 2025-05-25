<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *      schema="Project",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="title", type="string", example="Portfólio"),
 *      @OA\Property(property="short_description", type="string", example="Um projeto de portfólio"),
 *      @OA\Property(property="description", type="string", example="<p>Meu portfólio desenvolvido em Laravel</p>"),
 *      @OA\Property(property="completion_date", type="string", format="date", example="2025-04-28"),
 *      @OA\Property(property="thumbnail_url", type="string", format="url", example="http://localhost:8000/images/logo.png"),
 *      @OA\Property(property="status", ref="#/components/schemas/ProjectStatusEnum"),
 *      @OA\Property(property="url", type="string", format="url", example="http://localhost:8000/api/documentation"),
 *      @OA\Property(property="github_url", type="string", format="url", example="https://github.com/felipesilva15/portfolio-manager-api"),
 *      @OA\Property(property="project_type_id", type="integer", example=1),
 *      @OA\Property(property="project_type", ref="#/components/schemas/ProjectType"),
 *      @OA\Property(
 *          property="tags", 
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/Tag")
 *      ),
 *      @OA\Property(
 *          property="technologies", 
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/Technology")
 *      ),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z")
 * )
 */
class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'completion_date',
        'thumbnail_url',
        'status',
        'url',
        'github_url',
        'project_type_id'
    ];

    protected $with = [
        'tags:id,name',
        'project_type:id,name',
        'technologies:id,name'
    ];

    protected function casts(): array {
        return [
            'status' => ProjectStatus::class,
        ];
    }

    public function tags(): BelongsToMany {
        return $this->belongsToMany(Tag::class)
                    ->using(ProjectTag::class);
    }

    public function project_type(): BelongsTo {
        return $this->belongsTo(ProjectType::class);
    }

    public function technologies(): BelongsToMany {
        return $this->belongsToMany(Technology::class)
                    ->using(ProjectTechnology::class);
    }
}
