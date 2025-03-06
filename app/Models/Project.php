<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'completion_date',
        'thumbnail_url',
        'status'
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
}
