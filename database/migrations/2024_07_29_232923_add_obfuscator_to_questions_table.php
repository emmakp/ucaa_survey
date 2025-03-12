<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddObfuscatorToQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Temporarily disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Drop the table
        Schema::dropIfExists('questions');

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->unsignedBigInteger('questionaire_id');
            $table->string('question_type');
            $table->string('obfuscator')->unique();
            $table->boolean('required')->default(false)->nullable();
            $table->integer('stars')->nullable();
            $table->integer('max')->nullable();
            $table->timestamps();

            $table->foreign('questionaire_id')->references('id')->on('questionaires')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Drop the table
        Schema::dropIfExists('questions');

        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->unsignedBigInteger('questionaire_id');
            $table->unsignedBigInteger('question_type');
            $table->timestamps();

            $table->foreign('questionaire_id')->references('id')->on('questionaires')->onDelete('cascade');
            $table->foreign('question_type')->references('id')->on('question_types')->onDelete('cascade');
        });

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
