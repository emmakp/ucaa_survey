<?php

// database/migrations/2025_03_04_180000_create_audience_survey_pivot_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudienceSurveyPivotTable extends Migration
{
    public function up()
    {
        // Drop audience_id from surveys
        Schema::table('surveys', function (Blueprint $table) {
            $table->dropForeign(['audience_id']);
            $table->dropColumn('audience_id');
        });

        // Create pivot table
        Schema::create('audience_survey', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('survey_id');
            $table->unsignedBigInteger('audience_id');
            $table->timestamps();

            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');
            $table->foreign('audience_id')->references('id')->on('audiences')->onDelete('cascade');
            $table->unique(['survey_id', 'audience_id']); // Prevent duplicates
        });
    }

    public function down()
    {
        // Restore audience_id
        Schema::table('surveys', function (Blueprint $table) {
            $table->unsignedBigInteger('audience_id')->nullable()->after('created_by');
            $table->foreign('audience_id')->references('id')->on('audiences')->onDelete('set null');
        });

        // Drop pivot table
        Schema::dropIfExists('audience_survey');
    }
}