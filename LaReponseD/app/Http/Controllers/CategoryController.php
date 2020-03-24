<?php

namespace App\Http\Controllers;

use App\Category;
use App\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $quizs = Quiz::all();
        return view('categoryBlade.index', ['categories' => $categories, 'quizs' => $quizs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoryBlade.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'categName' => [
                    'required',
                    'max:255',
                    'unique:category,categoryName',
                ],
            ]);
    
            $newCateg = new Category;
            $newCateg->categoryName = $validatedData['categName'];
            $newCateg->save();
    
            return redirect()->route('dashboard')->with('success', 'La catégorie a correctement été ajoutée');

        } catch (\Throwable $th) {

            return back()->with('alert', 'Une erreur est survenue :(');
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
        return view('categoryBlade.edit', ['category' => Category::where('categoryId', 'LIKE', $id)->get()]);
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
                'categName' => [
                    'required',
                    'max:255',
                    'unique:category,categoryName',
                ],
            ]);
    
            DB::table('category')->where('categoryId','LIKE',$id)->update(['categoryName' => $validatedData['categName']]);
    
            return redirect()->route('dashboard')->with('success', 'Le nom de la catégorie a bien été modifié');

        } catch (\Throwable $th) {

            return back()->with('alert', 'Une erreur est survenue :(');
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

            /*-------MODIFY QUIZS THAT USES CURRENT CATEGORY--------*/
            DB::table('quiz')->where('RCategoryId','LIKE',$id)->update(['RCategoryId' => 1]);

            /*-------------------DELETE CATEGORY--------------------*/
            Category::where('categoryId', $id)->delete();

            return redirect()->route('dashboard')->with('success','Cette catégorie a été supprimée avec succès!');

        } catch (\Throwable $th) {

            return redirect()->route('dashboard')->with('alert','Une erreur est survenue');
        }
    }
}
