<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendEmailController extends Controller
{
    //
    function index()
    {
        return view('contact');
    }

    function send(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required',
            'email'     =>  'required|email',
            'message'   =>  'required'
        ]);

        $data = array(
            'name'      => $request->name,
            'email'      => $request->email,
            'message'   => $request->message
        );

        Mail::to('vtheo.ludon@gmail.com')->send(new SendMail($data));

        return back()->with('success', 'Merci de nous avoir contacté !');
    }
}
