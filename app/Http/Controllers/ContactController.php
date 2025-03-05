<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(Request $request, Contact $model) {
        $this->model = $model;
        $this->request = $request;
    }
}
