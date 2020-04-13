<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserNoteQuiz;
use App\Quiz;

class UserNoteQuizController extends Controller
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
        return view("usernoteBlade.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;
        $validatedQuiz = $request->validate([
            'titre' => 'required',
            'message' => 'required',
            'note' => 'required',
        ]);
        
        $newNote = new UserNoteQuiz;
        $newNote->userPostId = $userId;
        $newNote->RQuizId = $request->quizId;
        $newNote->titre = $request->titre;
        $newNote->corps = $request->message;
        $newNote->note = $request->note;
        $newNote->save();

        $allNote = UserNoteQuiz::select('note')->where('RQuizId', $request->quizId)->get();
        $nbNote = 0;
        $moyenne = 0;
        foreach ($allNote as $note) {
            $moyenne += $note->note;
            $nbNote += 1;
        }
        $moyenne = $moyenne / $nbNote;
        Quiz::where('quizId', $request->quizId)->update(array('noteAvg' => $moyenne));

        return redirect()->back()->withSuccess("c'est noté lol trop marrant");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usernote = UserNoteQuiz::where('userNoteQuizId', $id)->get();
        return view("usernoteBlade.show", ['usernote' => $usernote]);
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
        try {
            UserNoteQuiz::where('userNoteQuizId', $id)->delete();

            return redirect()->back()->with('success','Commentaire supprimé avec succès!');

        } catch (\Throwable $th) {

            return redirect()->back()->with('alert','Une erreur est survenue');
        }
    }
}
