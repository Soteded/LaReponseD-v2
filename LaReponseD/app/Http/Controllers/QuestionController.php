<?php

namespace App\Http\Controllers;

use App\Questions;
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
            //$newQuestion = ['question' => $request->question, 'RQuizId' => $quiz->quizId];

            $newQuestion = new Questions;
            $newQuestion->question = $request->question;
            $newQuestion->RQuizId = $quiz->quizId;
            $newQuestion->save();
            //$questionId = Questions::create($newQuestion)->lastInsertId();
            $questionId = DB::getPdo()->lastInsertId();
            $newChoix = new Choix;
            $newChoix->RQuestionId = $questionId;
            $newChoix->choixJuste = $request->repJuste;
            $newChoix->choix2 = $request->rep2;
            $newChoix->choix3 = $request->rep3;
            $newChoix->choix4 = $request->rep4;
            $newChoix->save();

            if ($_POST['action'] == 'again') {
                return view('quizBlade.questionBlade.create', ['quiz' => $quiz]);
            } else if ($_POST['action'] == 'end') {
                return redirect('home')->with('success','Bravo, vous avez cr?? votre quiz !');
            }
        } else {
            $messages = "Vous n'avez pas remplis tous les champs";
            return view('quizBlade.questionBlade.create', ['quiz' => $quiz])->withErrors($messages);
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
