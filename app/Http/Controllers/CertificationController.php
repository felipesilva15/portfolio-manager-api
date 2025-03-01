<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function __construct(Request $request, Certification $model) {
        $this->model = $model;
        $this->request = $request;
    }
}
