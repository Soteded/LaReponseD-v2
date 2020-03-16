<?php

use Illuminate\Database\Seeder;
use App\User;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()->each(function ($user){
            $user->profile()->save(factory(App\Profile::class)->create());
        });
    }
}
