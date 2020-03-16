<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('profile')) {
            Schema::create('profile', function (Blueprint $table) {
                $table->bigIncrements('profileId');
                $table->char('pseudo', 160);
                $table->date('birthDate');
                $table->string('telNbr', 32);
                $table->string('address', 250);
                $table->string('avatar')->default('user.jpg');
                $table->bigInteger('userId')->unsigned()->nullable();
                $table->foreign('userId')
                    ->references('id')
                    ->on('users');
                $table->timestamps();
            });
        }   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile');
    }
}
