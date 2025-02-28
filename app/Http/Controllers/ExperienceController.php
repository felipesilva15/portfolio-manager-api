<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function __construct(Request $request, Experience $model) {
        $this->model = $model;
        $this->request = $request;
    }
}
