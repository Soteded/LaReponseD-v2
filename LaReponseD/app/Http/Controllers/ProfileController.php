<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use Carbon\Carbon;
use Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd("Salut, c'est l'index des profiles");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $profiles = Profile::all();

        foreach ($profiles as $profile) {

            if ( $profile['userId'] === Auth::user()->id ) {
                return redirect('/home')->with('alert', 'Vous avez déjà un profile :(');
            }
        }

        return view('profileBlade.create');

        die();

        if (Profile::where('userId', '=', Auth::user()->id)) {
            echo ('J\' ai déjà un profile');
            die();
            return view('profileBlade.create');
            //return redirect('/home')->with('alert', 'Vous avez déjà un profile :(');
        } else {
            echo ('J\' ai pas un profile :(');
            die();
            return view('profileBlade.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $current_date_time = Carbon::now()->toDateTimeString();
        $newProfile = new Profile;

        if ($request->image == null) {
            $validatedProfile = $request->validate([
                'pseudo' => 'required',
                'birthDate' => 'required',
            ]);
        }else{
            $validatedProfile = $request->validate([
                'pseudo' => 'required',
                'birthDate' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images/avatar'), $imageName);
            $newProfile->avatar = $imageName;
        }

        $newProfile->pseudo = $request->pseudo;
        $newProfile->birthDate = $request->birthDate;
        $newProfile->userId = Auth::user()->id;

        $newProfile->created_at = $current_date_time;
        $newProfile->updated_at = $current_date_time;
        
        $newProfile->save();

        return redirect('/home')->with('success', 'Profil créé avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::where('profileId', $id)->get();
        return view('profileBlade.show', [ "profile" => $profile[0] ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::where('profileId', $id)->get();
        return view('profileBlade.edit', [ "profile" => $profile[0] ]);
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

    /**
     * Modify user's profile image
     *
     * @return \Illuminate\Http\Response
     */
    public function update_avatar(Request $request){
        // Logic for user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return view('profile', ['user' => Auth::user()] );
    }

}
