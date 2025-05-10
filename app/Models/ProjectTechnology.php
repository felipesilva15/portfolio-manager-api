<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectTechnology extends Pivot
{
    protected $table = 'project_technology';
}
