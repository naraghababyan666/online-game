<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('right_answer');
//            $table->unsignedBigInteger('clue_id');
//            $table->foreign('clue_id')->references('id')->on('clues')->onDelete('cascade');
            $table->foreignId('round_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
        Schema::table('answers', function (Blueprint $table){
            $table->dropForeign('answers_round_id_foreign');
        });
    }
}
