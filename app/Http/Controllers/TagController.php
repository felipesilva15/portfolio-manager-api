<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct(Request $request, Tag $model) {
        $this->model = $model;
        $this->request = $request;
    }
}
