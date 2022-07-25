<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCluesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clues', function (Blueprint $table) {
            $table->id();
            $table->string('clue');
//            $table->foreignId('rounds_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('round_id');
            $table->foreign('round_id')->references('id')->on('rounds')->onDelete('cascade');
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
        Schema::dropIfExists('clues');
        Schema::table('rounds', function (Blueprint $table){
            $table->dropForeign('clues_round_id_foreign');
        });
    }
}
