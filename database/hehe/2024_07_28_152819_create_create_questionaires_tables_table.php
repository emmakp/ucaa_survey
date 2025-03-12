<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateQuestionairesTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionaires', function (Blueprint $table) {
            $table->id();
            $table->string('obfuscator')->unique();
            $table->unsignedBigInteger('survey_id');
            $table->tinyInteger('validity');
            $table->unsignedBigInteger('target_audience');
            $table->timestamps();

            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
            $table->foreign('target_audience')->references('id')->on('audiences')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('questionaires');
    }

}
