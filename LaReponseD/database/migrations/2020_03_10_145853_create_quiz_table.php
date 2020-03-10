<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz', function (Blueprint $table) {
            $table->bigIncrements('QuizId');
            $table->foreign('CategoryId')->references('CategoryId')->on('category');
            $table->foreign('CreatorId')->references('UserId')->on('users');
            $table->integer('NoteAvg');

            $table->timestamps('CreatedAt');
            $table->timestamps('UpdateAt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz');
    }
}
