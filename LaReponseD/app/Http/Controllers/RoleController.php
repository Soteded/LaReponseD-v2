<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Profile;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
class RoleController extends Controller
{
    public function setRole(Request $request) {
        //dd($request->all());
        //return view('profileBlade.show', ['profile' => $profile])->with('success','Bravo, vous avez changé le role de timothéLeModo !');

        $truc = $request->aled;
        
        //dd($truc);

        $profile = Profile::where('id', $request->profileId)->first();
        $user = User::where('id',$request->profileId)->first();

        if ($truc == 'moderator') {
            $newRole = Role::where('name', 'Modo')->first();
            $user->roles()->detach();

            $user->assignRole($newRole);

            return redirect()->route('show', ['id' => $profile->id])->with('success',"$profile->firstName $profile->lastName est devenu un modérateur");
        } elseif ($truc == 'user') {
            $newRole = Role::where('name', 'User')->first();
            $user->roles()->detach();

            $user->assignRole($newRole);

            return redirect()->route('show', ['id' => $profile->id])->with('success',"$profile->firstName $profile->lastName est devenu un utilisateur");
        } else {
            print($truc.'rien');
        }
        
    }
}
