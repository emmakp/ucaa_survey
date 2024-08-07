<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateQuestionTypesTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('obfuscator')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('question_types');
    }

}
