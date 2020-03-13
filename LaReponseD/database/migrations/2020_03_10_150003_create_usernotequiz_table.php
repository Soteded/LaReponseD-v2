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
            $table->bigIncrements('userNoteQuizId');
            $table->bigInteger('RUserId')->unsigned()->nullable();
            $table->foreign('RUserId')
                ->references('id')
                ->on('users');
            $table->bigInteger('RQuizId')->unsigned()->nullable();
            $table->foreign('RQuizId')
                ->references('quizId')
                ->on('quiz');
            $table->integer('note');
            $table->char('titre', 250);
            $table->text('corps');
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
