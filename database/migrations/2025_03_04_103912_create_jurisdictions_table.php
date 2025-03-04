<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurisdictionsTable extends Migration
{
    public function up()
    {
        Schema::create('jurisdictions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., "Passenger", "Staff", "Vendor"
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jurisdictions');
    }
}