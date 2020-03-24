<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
        //
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
        return view("userBlade.edit");
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
        try {
            $validatedData = $request->validate([
                'username' => [
                    'not_regex:/^(pute|salope|oui|non|invalide)$/i',
                    'required',
                    'max:255'
                ],
            ]);
    
            DB::table('users')->where('id','LIKE',$id)->update(['name' => $validatedData['username']]);
    
            return redirect()->route('home')->with('success', 'Le nom d\'utilisateur à correctement été changé');

        } catch (\Throwable $th) {

            return back()->with('alert', 'Votre nom d\'utilisateur est invalide.');

        }
    }

    public function invalidUsername($id)
    {
        try {

            DB::table('users')->where('id','LIKE',$id)->update(['name' => ""]);

            return redirect()->route('dashboard')->with('success','Le nom d\'utilisateur à correctement été changé');

        } catch (\Throwable $th) {

            return redirect()->route('dashboard')->with('alert','Une erreur est survenue');
        }
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

            /*--------DELETE USER'S PROFILE--------*/
            DB::table('profile')->select(DB::raw('*'))->where('userId','LIKE',$id)->delete();

            /*---------DELETE USER'S QUIZS---------*/
            DB::table('quiz')->where('CreatorId','LIKE',$id)->update(['CreatorId' => 1]);

            // /*-------DELETE USER'S COMMENTS--------*/
            DB::table('usernotequiz')->where('userPostId','LIKE',$id)->update(['userPostId' => 1]);

            /*-------------DELETE USER-------------*/
            User::where('id', $id)->delete();

            return redirect()->route('dashboard')->with('success','Utilisateur supprimé avec succès!');

        } catch (\Throwable $th) {

            return redirect()->route('dashboard')->with('alert','Une erreur est survenue');
        }
    }
}
