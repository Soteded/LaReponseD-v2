<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $profiles = Profile::all();
        return view('profileBlade.index', ["profiles" => $profiles]);
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
                return redirect()->back()->with('alert', 'Vous avez déjà un profile :(');
            }
        }

        return view('profileBlade.create');
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
        $current_date_time = Carbon::now()->toDateTimeString();

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
        }

        $curP = Profile::find($id);
        
        $curP->pseudo = $request->pseudo;
        $curP->birthDate = $request->birthDate;
        $curP->avatar = $imageName;

        $curP->updated_at = $current_date_time;
        
        $curP->save();

        return redirect()->route('profile.show', $id)->with('success', 'Profil mis à jour avec succès !');
    }

    public function invalidPseudo($id)
    {
        try {

            DB::table('profile')->where('profileId','LIKE',$id)->update(['pseudo' => ""]);

            return redirect()->back()->with('success','Le pseudo à correctement été changé');

        } catch (\Throwable $th) {

            dd($th);

            return redirect()->back()->with('alert','Une erreur est survenue');
        }
    }
    
    public function editPseudo($id)
    {
        $profile = Profile::where('profileId', $id)->get();
        return view('profileBlade.editPseudo', [ "profile" => $profile[0] ]);
    }

    public function updatePseudo(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'pseudo' => [
                    'not_regex:/^(pute|salope|oui|non|invalide)$/i',
                    'required',
                    'max:255'
                ],
            ]);
    
            DB::table('profile')->where('profileId','LIKE',$id)->update(['pseudo' => $validatedData['pseudo']]);
    
            return redirect()->route('home')->with('success', 'Le pseudo à correctement été changé');

        } catch (\Throwable $th) {

            return back()->with('alert', 'Le pseudo choisi est invalide.');

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
