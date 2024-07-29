<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionFormController extends Controller
{
    public function index()
    {
        return view('questions.form');
    }
}
