<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class QuestionnaireController extends Controller
{
    /**
     * a
     *
     * @param  a
     * @return a
     */
    public function inputForm(Request $request)
    {
        print_r( $request->input('question.0'));
    }
}