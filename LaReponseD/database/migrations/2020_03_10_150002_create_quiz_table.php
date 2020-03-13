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
            $table->bigInteger('RCreatorId')->unsigned()->nullable();
            $table->foreign('RCreatorId')
                ->references('userId')
                ->on('users');
            $table->integer('noteAvg');

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
