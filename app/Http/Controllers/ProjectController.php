<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(Request $request, Project $model) {
        $this->model = $model;
        $this->request = $request;
    }
}
