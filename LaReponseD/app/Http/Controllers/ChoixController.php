<?php

namespace App\Http\Controllers;

use App\Choix;
use App\Question;
use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChoixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_id = Auth::user()->id;
        $quiz = Quiz::where('user_id', $current_id)->latest('created_at')->first();
        $question = Question::where('quiz_id', $quiz->id)->latest('created_at')->first();

        $reponses = array($request->reponses[0],$request->reponses[1],$request->reponses[2],$request->reponses[3]);

        $newRep = new Choix;

        if (in_array($request->quest1, $reponses)) {
            $j = 1;

            for ($i=0; $i < sizeof($reponses); $i++) {
                if ($reponses[$i] != $request->quest1) {
                    $aled = "choix{$j}";
                    $newRep->$aled = $reponses[$i];
                    $j += 1;
                } else {
                    $newRep->choix0 = $reponses[$i];
                }
            }
            $newRep->question_id = $question->id;

            $newRep->save();
        } else {
            $messages = "Veuillez choisir une option";
            return view('quizBlade.choix.create', ['quiz' => $quiz,'question' => $question, 'reponses' => $reponses])->withErrors($messages);
        }

        if ($_POST['action'] == 'again') {
            return view('quizBlade.question.create', ['quiz' => $quiz]);
        } else if ($_POST['action'] == 'end') {
            return redirect('home')->with('success','Bravo, vous avez cr?? votre quiz !');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
