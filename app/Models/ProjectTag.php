<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectTag extends Pivot
{
    protected $table = 'project_tag';
}
