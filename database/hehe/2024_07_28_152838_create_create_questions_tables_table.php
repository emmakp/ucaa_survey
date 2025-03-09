<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateQuestionsTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->unsignedBigInteger('questionaire_id');
            $table->unsignedBigInteger('question_type');
            $table->timestamps();

            $table->foreign('questionaire_id')->references('id')->on('questionaires')->onDelete('cascade');
            $table->foreign('question_type')->references('id')->on('question_types')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('questions');
    }

}
