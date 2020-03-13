<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChoixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('choix', function (Blueprint $table) {
            $table->bigIncrements('choixId');
            $table->bigInteger('RQuestionId')->unsigned()->nullable();
            $table->foreign('RQuestionId')
                ->references('questionId')
                ->on('questions');
            $table->string('choixJuste');
            $table->string('choix2');
            $table->string('choix3');
            $table->string('choix4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('choix');
    }
}
