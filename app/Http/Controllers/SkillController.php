<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function __construct(Request $request, Skill $model) {
        $this->model = $model;
        $this->request = $request;
    }
}
