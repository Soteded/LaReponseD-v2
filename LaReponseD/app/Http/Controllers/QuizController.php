<?php

namespace App\Http\Controllers;

use App\Questions;
use App\Quiz;
use App\Choix;
use App\Category;
use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use http\Exception\InvalidArgumentException;
use function Symfony\Component\HttpKernel\Tests\Controller\controller_function;
use function Symfony\Component\HttpKernel\Tests\controller_func;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizs = Quiz::all()->sortByDesc('created_at');
        return view('quizBlade.index', ['quizs' => $quizs]);
    }

    public function create()
    {
        $categorys = Category::where("categoryId", '>', 1)->get();
        return view('quizBlade.create', ['categorys' => $categorys]);
    }

    public function store(Request $request)
    {
        $validatedQuiz = $request->validate([
            'titre' => 'required',
            'theme' => 'required',
        ]);

        $newQuiz = new Quiz;
        $userId = Auth::user()->id;
        $newQuiz->titre = $request->titre;
        $newQuiz->RCategoryId = $request->theme;
        $newQuiz->CreatorId = $userId;

        $newQuiz->save();

        $newQuiz = Quiz::with('category')->where('CreatorId', $userId)->latest('created_at')->first();
        
        return view('quizBlade.questionBlade.create', ['quiz' => $newQuiz], ['questions' => null ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quiz = Quiz::with('questions.choix')->find($id);
        return view('quizBlade.show', ['quiz' => $quiz]);
    }

    public function edit($id)
    {
        $quiz = Quiz::with('questions.choix')->with('category')->find($id);
        $categorys = Category::where("categoryId", '>', 1)->get();
        return view('quizBlade.edit', ['quiz' => $quiz], ['categorys' => $categorys]);
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
        if (isset($request->theme)) {
            $quiz = Quiz::find($id);
            $quiz->RCategoryId = $request->theme;
            $quiz->save();
            $messages = "theme update";
        }else if (isset($request->questions) && isset($request->questions['question']) && isset($request->questions['choixJuste']) && isset($request->questions['choix2']) && isset($request->questions['choix3']) && isset($request->questions['choix4'])) {
            $question = Questions::find($request->questions['questionId']);
            $question->question = $request->questions['question'];
            $question->save();
            $question->choix->choixJuste = $request->questions['choixJuste'];
            $question->choix->choix2 = $request->questions['choix2'];
            $question->choix->choix3 = $request->questions['choix3'];
            $question->choix->choix4 = $request->questions['choix4'];
            $question->choix->save();

            $messages = "Question et Choix update";
        }else {
            $messages = "Vous n'avez pas remplis tous les champs";
            return redirect('/quiz/edit/'.$id)->withErrors($messages);
        }

        return redirect('/quiz/edit/'.$id)->with($messages);

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

    public function verify(Request $request) {
        $points = 0;
        $quiz = Quiz::with('questions.choix')->find($request->quizId);
        $questions = $quiz->questions;
        $pointsMax = sizeof($questions);
        for ($i=0; $i < $pointsMax; $i++) {
            if ($questions[$i]->choix->choixJuste == $request[$i]) {
                $points += 1;
            }
        }

        $quiz->compteur += 1;
        $quiz->save();

        return view('quizBlade.results', ['points' => $points, 'pointsMax' => $pointsMax]);
    }
}


