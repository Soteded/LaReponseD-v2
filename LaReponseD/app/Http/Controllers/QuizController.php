<?php

namespace App\Http\Controllers;

use App\Question;
use App\Quiz;
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
        //
    }

    public function create()
    {
        $categorys = Category::all();
        return view('quizBlade.create', ['categorys' => $categorys]);
    }

    public function store(Request $request)
    {
        $validatedQuiz = $request->validate([
            'titre' => 'required',
            'theme' => 'required',
        ]);

        $newQuiz = new Quiz;

        $newQuiz->titre = $request->titre;
        $newQuiz->RCategoryId = $request->theme;
        $newQuiz->CreatorId = Auth::user()->id;

        $newQuiz->save();
        
        return view('quizBlade.questionBlade.create', ['quiz' => $newQuiz]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $quiz = Quiz::with('questions.choix');
        return view('quizBlade.show', ['quiz' => $quiz]);
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
