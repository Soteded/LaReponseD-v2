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
            $table->foreign('UserId')->references('UserId')->on('users');
            $table->foreign('QuizId')->references('QuizId')->on('quiz');
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
