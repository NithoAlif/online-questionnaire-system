<?php

namespace App\Http\Controllers;

use DB;
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
        // Assumption: Creating new form
        $que_id = DB::table('questionnaire')->insertGetId(
                ['title' => 'Test Q']
            );

        $total = $request->input('questions');
        $possible_counter = 0;

        for ($i = 0; $i < $total; $i++) {

            $questions = $request->input('question.' . $i);
            $sidenote = $request->input('sidenote.' . $i);
            $type = $request->input('type.' . $i);
            
            $q_id = DB::table('questions')->insertGetId(
                    ['questions' => $questions, 
                     'sidenote' => $sidenote,
                     'type' => $type,
                     'que_id' => $que_id ]);

            if ( ( $type != 'short' ) && ( $type != 'long' ) ) {
                $tpanswer = $request->input('tpanswers.' . $i);
                $possible_counter += $tpanswer;

                for ($j = $possible_counter - $tpanswer; $j < $possible_counter; $j++) {
                    DB::table('possible_answers')->insert(
                        ['answer' => ( $request->input('panswers.' . $j)),
                         'q_id' => $q_id]);
                }
            }

            echo "Success";
        }

    }
}