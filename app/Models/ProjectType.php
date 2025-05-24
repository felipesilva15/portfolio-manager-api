<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *      schema="ProjectType",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="name", type="string", example="Back-end"),
 *      @OA\Property(property="created_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z"),
 *      @OA\Property(property="updated_at", type="string", format="date-time", example="2025-04-28T11:23:31.000000Z")
 * )
 */
class ProjectType extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function projects(): HasMany {
        return $this->hasMany(Project::class);
    }
}
