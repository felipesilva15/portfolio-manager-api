<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function __construct(Request $request, Education $model) {
        $this->model = $model;
        $this->request = $request;
    }
}
