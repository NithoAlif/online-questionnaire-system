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
        $total = $request->input('questions');
        echo ($total);

        $possible_counter = 0;
        echo "<br><br>";

        for ($i = 0; $i < $total; $i++) {
            echo ( $request->input('question.' . $i) );
            echo "<br>";
            echo ( $request->input('sidenote.' . $i) );
            echo "<br>";
            
            $type = $request->input('type.' . $i);
            echo ( $type );
            echo "<br>";
        
            if ( ( $type != 'short' ) && ( $type != 'long' ) ) {
                $tpanswer = $request->input('tpanswers.' . $i);
                $possible_counter += $tpanswer;
                echo ( $tpanswer );

                for ($j = $possible_counter - $tpanswer; $j < $possible_counter; $j++) {
                    echo "<br>";
                    echo ( $request->input('panswers.' . $j));
                }
            }

            echo "<br><br>";
        }

    }
}