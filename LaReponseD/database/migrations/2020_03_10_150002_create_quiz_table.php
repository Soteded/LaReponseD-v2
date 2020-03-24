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
            $table->bigIncrements('quizId');
            $table->bigInteger('RCategoryId')->unsigned()->nullable();
            $table->foreign('RCategoryId')
                ->references('categoryId')
                ->on('category');
            $table->bigInteger('CreatorId')->unsigned()->nullable();
            $table->foreign('CreatorId')
                ->references('id')
                ->on('users');
            $table->string('titre');
            $table->integer('noteAvg')->nullable();
            $table->integer('compteur')->nullable();

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
        Schema::dropIfExists('quiz');
    }
}
