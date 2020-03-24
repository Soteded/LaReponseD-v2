<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tUser = App\User::create([
            'name' => "Deleted",
            'email' => "deleted@this.website",
            'password' => Hash::make("passwordSecure"),
        ]);
        $tUser->save();

        $role_admin = Role::where('name','Admin')->first();

        factory(App\User::class, 5)->create()->each(function ($user) use ($role_admin) {
            $user->assignRole($role_admin);
        });

        $role_modo = Role::where('name','Modo')->first();

        factory(App\User::class, 5)->create()->each(function ($user) use ($role_modo) {
            $user->assignRole($role_modo);
        });

        $role_user = Role::where('name','User')->first();

        factory(App\User::class, 5)->create()->each(function ($user) use ($role_user) {
            $user->assignRole($role_user);
        });
    }
}
