<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreateAudiencesTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audiences', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('created_by');
            $table->string('obfuscator')->unique();
            $table->timestamps();
            $table->tinyInteger('validity');
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audiences');
    }

}
