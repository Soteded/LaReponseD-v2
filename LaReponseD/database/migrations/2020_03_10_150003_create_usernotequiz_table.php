<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsernotequizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usernotequiz', function (Blueprint $table) {
            $table->bigIncrements('UserNoteQuizId');
            $table->bigInteger('RUserId')->unsigned()->nullable();
            $table->foreign('RUserId')
                ->references('UserId')
                ->on('users');
            $table->bigInteger('RQuizId')->unsigned()->nullable();
            $table->foreign('RQuizId')
                ->references('QuizId')
                ->on('quiz');
            $table->integer('Note');
            $table->char('Titre', 250);
            $table->text('Corps');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usernotequiz');
    }
}
