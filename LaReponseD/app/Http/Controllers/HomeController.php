<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Quiz;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application main page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $users = User::all();
        $categories = Category::all();
        $quizs = Quiz::all();

        return view('dashboard', ['users' => $users, 'categories' => $categories, 'quizs' => $quizs]);
    }

    public function contact(){
        return view('contact');
    }

    public function sendMail(Request $request){
        try {
            dd($request->all());

            return redirect()->back()->with('success', 'Votre mail a bien été transmis !');
            // SEND MAIL + RETURN
        } catch (\Throwable $th) {

            dd($th);
            
            return redirect()->back()->with('error', 'Une erreur est survenue');
        }
    }
}
