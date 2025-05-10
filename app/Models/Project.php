<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
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
