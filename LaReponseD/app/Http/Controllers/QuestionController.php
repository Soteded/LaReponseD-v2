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
        
        dd($questions);
        return View::make('quizBlade.questionBlade.createQuest', ['quiz' => $quiz], ['questions' => $questions]);
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

            $newQuestion = new Questions;
            $newQuestion->question = $request->question;
            $newQuestion->RQuizId = $quiz->quizId;
            $newQuestion->save();
            
            $newChoix = new Choix;
            $newChoix->RQuestionId = $newQuestion->questionId;
            $newChoix->choixJuste = $request->repJuste;
            $newChoix->choix2 = $request->rep2;
            $newChoix->choix3 = $request->rep3;
            $newChoix->choix4 = $request->rep4;
            $newChoix->save();

            $questions = Questions::with('choix')->where('RQuizId', $quiz->quizId)->get();

            if ($_POST['action'] == 'again') {
                return view('quizBlade.questionBlade.create', ['quiz' => $quiz], ['questions' => $questions]);
            } else if ($_POST['action'] == 'end') {
                return redirect('home')->with('success','Bravo, vous avez cr?? votre quiz !');
            }

        } else {
            $questions = Questions::with('choix')->where('RQuizId', $quiz->quizId)->get();
            $messages = "Vous n'avez pas remplis tous les champs";
            return view('quizBlade.questionBlade.create', ['quiz' => $quiz], ['questions' => $questions])->withErrors($messages);
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
