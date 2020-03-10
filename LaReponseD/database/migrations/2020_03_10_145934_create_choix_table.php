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
            $table->bigIncrements('ChoixId');
            $table->foreign('QuestionId')->references('QuestionId')->on('questions');
            $table->string('ChoixJuste');
            $table->string('Choix2');
            $table->string('Choix3');
            $table->string('Choix4');
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
