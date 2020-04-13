<?php

namespace App\Http\Controllers;
use App\Report;
use Illuminate\Http\Request;

class reportController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'idReported' => 'required',
            'type' => 'required',
            'message' => 'required'
        ]);
        $newReport = new Report;
        $newReport->idReported = $request->idReported;
        $newReport->message = $request->message;
        if ($request->type == 'quiz' || $request->type == 'user') {
            $newReport->type = $request->type;
        } else {
            return redirect()->back()->withErrors("prob frer")->withInput();
        }

        $newReport->save();

        return redirect()->back()->withSuccess("Report réussi");
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        try {
            /*-------------DELETE QUIZ-------------*/
            Report::where('reportId', $id)->delete();

            return redirect()->back()->with('success','Signalement supprimé avec succès!');

        } catch (\Throwable $th) {

            dd($th);

            return redirect()->back()->with('alert','Une erreur est survenue');
        }
    }
}
