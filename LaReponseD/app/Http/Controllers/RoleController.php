<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Profile;
use App\User;
use Spatie\Permission\Models\Role;
class RoleController extends Controller
{
    public function viewRole($id) {

        try {
            $user = User::find($id);
            return view('userBlade.changeRole', ['user' => $user]);

        } catch (\Throwable $th) {

            return redirect()->back()->with('error','Une erreur est survenue');
        }
    }

    public function updateRole($id,$role){
        try {

            $newRole = Role::where('name', $role)->first();

            $user = User::find($id);
            $user->roles()->detach();
            $user->assignRole($newRole);

            return redirect()->route('dashboard')->with('success', `Le role de $user->name a été changé pour $newRole->name.`);
        
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error','Une erreur est survenue');
        }
    }
}
