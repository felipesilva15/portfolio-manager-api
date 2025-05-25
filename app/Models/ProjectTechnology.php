<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @OA\Schema(
 *      schema="ProjectTechnology",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="name", type="string", example="Laravel")
 * )
 */
class ProjectTechnology extends Pivot
{
    protected $table = 'project_technology';
}
