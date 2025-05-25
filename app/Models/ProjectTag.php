<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @OA\Schema(
 *      schema="ProjectTag",
 *      @OA\Property(property="id", type="integer", example=1),
 *      @OA\Property(property="name", type="string", example="API")
 * )
 */
class ProjectTag extends Pivot
{
    protected $table = 'project_tag';
}
