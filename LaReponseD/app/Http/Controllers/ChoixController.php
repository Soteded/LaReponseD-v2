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
    public function store()
    {
        $current_id = Auth::user()->id;
        $quiz = Quiz::where('CreatorId', $current_id)->latest('created_at')->first();
        $question = Question::where('RQuizId', $quiz->quizid)->latest('created_at')->first();

        $newchoix = new Choix;

        foreach ($listChoix as $key => $choix) {
            switch ($key) {
                case 'repJuste':
                    $newchoix->choixJuste = $choix;
                    break;
                case 'rep2':
                    $newchoix->choix2 = $choix;
                    break;
                case 'rep3':
                    $newchoix->choix3 = $choix;
                    break;
                case 'rep4':
                    $newchoix->choix4 = $choix;
                    break;
                default:
                    break;
            }
        }
        $newchoix->RQuestionId = $question->questionId;
        $newchoix->save();
        //if ($_POST['action'] == 'again') {
          //  return view('quizBlade.questionBlade.create', ['quiz' => $quiz]);
        //} else if ($_POST['action'] == 'end') {
          //  return redirect('home')->with('success','Bravo, vous avez cr?? votre quiz !');
        //}
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
