<?php

namespace App\Http\Controllers;

use App\Question;
use App\Choix;
use App\Quiz;
use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
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
    public function create($quiz)
    {
        $current_id = Auth::user()->id;
        $quiz = Quiz::where('user_id', $current_id)->latest('created_at')->first();

        return View::make('quizBlade.questionBlade.createQuest', ['quiz' => $quiz]);
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
        $quiz = Quiz::where('CreatorId', $current_id)->latest('created_at')->first();
    
        if (isset($request->question) && isset($request->repJuste) && isset($request->rep2) && isset($request->rep3) && isset($request->rep4)) {
            $newQuestion = new Question;

            $newQuestion->question = $request->question;
            $newQuestion->RQuizId = $quiz->quizId;

            $newQuestion->save();

            $listChoix = array('repJuste' => $request->request->get('repJuste'),
                        'rep2' => $request->request->get('rep2'),
                        'rep3' => $request->request->get('rep3'),
                        'rep4' => $request->request->get('rep4'));

            return redirect()->action('ChoixController@store', ['listChoix' => $listChoix]);
        } else {
            $messages = "Vous n'avez pas remplis tous les champs";
            return view('quizBlade.question.create', ['quiz' => $quiz])->with('error','Vous n\'avez pas rentré tous les champs requis')->withErrors($messages);
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
